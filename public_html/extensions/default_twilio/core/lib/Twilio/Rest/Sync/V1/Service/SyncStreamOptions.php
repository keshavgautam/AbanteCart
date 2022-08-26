<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Sync\V1\Service;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
abstract class SyncStreamOptions
{
    /**
     * @param string  $uniqueName Stream unique name.
     * @param integer $ttl        Stream TTL.
     *
     * @return CreateSyncStreamOptions Options builder
     */
    public static function create($uniqueName = Values::NONE, $ttl = Values::NONE)
    {
        return new CreateSyncStreamOptions($uniqueName, $ttl);
    }

    /**
     * @param integer $ttl Stream TTL.
     *
     * @return UpdateSyncStreamOptions Options builder
     */
    public static function update($ttl = Values::NONE)
    {
        return new UpdateSyncStreamOptions($ttl);
    }
}

class CreateSyncStreamOptions extends Options
{
    /**
     * @param string  $uniqueName Stream unique name.
     * @param integer $ttl        Stream TTL.
     */
    public function __construct($uniqueName = Values::NONE, $ttl = Values::NONE)
    {
        $this->options['uniqueName'] = $uniqueName;
        $this->options['ttl'] = $ttl;
    }

    /**
     * The unique and addressable name of this Stream. Optional, up to 256 characters long.
     *
     * @param string $uniqueName Stream unique name.
     *
     * @return $this Fluent Builder
     */
    public function setUniqueName($uniqueName)
    {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }

    /**
     * Optional time-to-live of this Stream in seconds. In the range [1, 31 536 000 (1 year)], or 0 for infinity.
     *
     * @param integer $ttl Stream TTL.
     *
     * @return $this Fluent Builder
     */
    public function setTtl($ttl)
    {
        $this->options['ttl'] = $ttl;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString()
    {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Sync.V1.CreateSyncStreamOptions '.implode(' ', $options).']';
    }
}

class UpdateSyncStreamOptions extends Options
{
    /**
     * @param integer $ttl Stream TTL.
     */
    public function __construct($ttl = Values::NONE)
    {
        $this->options['ttl'] = $ttl;
    }

    /**
     * Time-to-live of this Stream in seconds. In the range [1, 31 536 000 (1 year)], or 0 for infinity.
     *
     * @param integer $ttl Stream TTL.
     *
     * @return $this Fluent Builder
     */
    public function setTtl($ttl)
    {
        $this->options['ttl'] = $ttl;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString()
    {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Sync.V1.UpdateSyncStreamOptions '.implode(' ', $options).']';
    }
}