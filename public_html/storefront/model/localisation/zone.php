<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */

/*------------------------------------------------------------------------------
  $Id$

  AbanteCart, Ideal OpenSource Ecommerce Solution
  http://www.AbanteCart.com

  Copyright © 2011-2022 Belavier Commerce LLC

  This source file is subject to Open Software License (OSL 3.0)
  License details is bundled with this package in the file LICENSE.txt.
  It is also available at this URL:
  <http://www.opensource.org/licenses/OSL-3.0>

 UPGRADE NOTE:
   Do not edit or add to this file if you wish to upgrade AbanteCart to newer
   versions in the future. If you wish to customize AbanteCart for your
   needs please refer to http://www.AbanteCart.com for more information.
------------------------------------------------------------------------------*/

/**
 * Class ModelLocalisationZone
 */
class ModelLocalisationZone extends Model
{
    /**
     * @param int $zone_id
     * Note: Default language text is picked up if no selected language available
     *
     * @return array
     * @throws AException
     */
    public function getZone($zone_id)
    {
        $language_id = $this->language->getLanguageID();
        $default_lang_id = $this->language->getDefaultLanguageID();

        $query = $this->db->query(
            "SELECT z.*, COALESCE(zd1.name,zd2.name) as name 
            FROM ".$this->db->table("zones")." z
            LEFT JOIN ".$this->db->table("zone_descriptions")." zd1
                ON (z.zone_id = zd1.zone_id AND zd1.language_id = '".(int) $language_id."')
            LEFT JOIN ".$this->db->table("zone_descriptions")." zd2
                ON (z.zone_id = zd2.zone_id AND zd2.language_id = '".(int) $default_lang_id."')
            WHERE z.zone_id = '".(int) $zone_id."' 
                AND status = '1'"
        );
        return $query->row;
    }

    /**
     * @param int $country_id
     * Note: Default language text is picked up if no selected language available
     *
     * @return array
     * @throws AException
     */
    public function getZonesByCountryId($country_id)
    {
        $language_id = $this->language->getLanguageID();
        $default_lang_id = $this->language->getDefaultLanguageID();

        $cache_key = 'localization.zone.sf.'.$country_id.'.lang_'.$language_id;
        $zone_data = $this->cache->pull($cache_key);

        if ($zone_data === false) {
            $query = $this->db->query(
                "SELECT z.*, COALESCE(zd1.name,zd2.name) as name 
                FROM ".$this->db->table("zones")." z
                LEFT JOIN ".$this->db->table("zone_descriptions")." zd1
                    ON (z.zone_id = zd1.zone_id AND zd1.language_id = '".(int) $language_id."')
                LEFT JOIN ".$this->db->table("zone_descriptions")." zd2
                    ON (z.zone_id = zd2.zone_id AND zd2.language_id = '".(int) $default_lang_id."')
                WHERE z.country_id = '".(int) $country_id."' 
                    AND status = '1'
                ORDER BY zd1.name,zd2.name"
            );
            $zone_data = $query->rows;
            $this->cache->push($cache_key, $zone_data);
        }
        return $zone_data;
    }

    /**
     * @param string $country_name
     *
     * @return array
     * @throws AException
     */
    public function getZonesByCountryName($country_name)
    {
        if (empty($country_name)) {
            return [];
        }
        return $this->getZonesByCountryId($this->getCountryIdByName($country_name));
    }

    /**
     * @param string $name
     * Note: Default language text is picked up if no selected language available
     *
     * @return int
     * @throws AException
     */
    public function getCountryIdByName($name)
    {
        $language_id = $this->language->getLanguageID();
        $default_language_id = $this->language->getDefaultLanguageID();

        $query = $this->db->query(
            "SELECT c.country_id
            FROM ".$this->db->table("countries")." c
            LEFT JOIN ".$this->db->table("country_descriptions")." cd1
                ON (c.country_id = cd1.country_id AND cd1.language_id = '".(int) $language_id."')
            LEFT JOIN ".$this->db->table("country_descriptions")." cd2
                ON (c.country_id = cd2.country_id AND cd2.language_id = '".(int) $default_language_id."')
            WHERE (cd1.name = '".$this->db->escape($name)."' OR cd2.name = '".$this->db->escape($name)."')
                AND status = '1'
            LIMIT 1"
        );
        return (int) $query->row['country_id'];
    }
}
