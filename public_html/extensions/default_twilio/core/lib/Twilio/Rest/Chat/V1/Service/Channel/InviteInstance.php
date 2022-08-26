<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Chat\V1\Service\Channel;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;

/**
 * @property string    sid
 * @property string    accountSid
 * @property string    channelSid
 * @property string    serviceSid
 * @property string    identity
 * @property \DateTime dateCreated
 * @property \DateTime dateUpdated
 * @property string    roleSid
 * @property string    createdBy
 * @property string    url
 */
class InviteInstance extends InstanceResource
{
    /**
     * Initialize the InviteInstance
     *
     * @param \Twilio\Version $version    Version that contains the resource
     * @param mixed[]         $payload    The response payload
     * @param string          $serviceSid The service_sid
     * @param string          $channelSid The channel_sid
     * @param string          $sid        The sid
     *
     * @return \Twilio\Rest\Chat\V1\Service\Channel\InviteInstance
     */
    public function __construct(Version $version, array $payload, $serviceSid, $channelSid, $sid = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = array(
            'sid'         => Values::array_get($payload, 'sid'),
            'accountSid'  => Values::array_get($payload, 'account_sid'),
            'channelSid'  => Values::array_get($payload, 'channel_sid'),
            'serviceSid'  => Values::array_get($payload, 'service_sid'),
            'identity'    => Values::array_get($payload, 'identity'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'roleSid'     => Values::array_get($payload, 'role_sid'),
            'createdBy'   => Values::array_get($payload, 'created_by'),
            'url'         => Values::array_get($payload, 'url'),
        );

        $this->solution = array(
            'serviceSid' => $serviceSid,
            'channelSid' => $channelSid,
            'sid'        => $sid ?: $this->properties['sid'],
        );
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return \Twilio\Rest\Chat\V1\Service\Channel\InviteContext Context for this
     *                                                            InviteInstance
     */
    protected function proxy()
    {
        if (!$this->context) {
            $this->context = new InviteContext(
                $this->version,
                $this->solution['serviceSid'],
                $this->solution['channelSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch a InviteInstance
     *
     * @return InviteInstance Fetched InviteInstance
     */
    public function fetch()
    {
        return $this->proxy()->fetch();
    }

    /**
     * Deletes the InviteInstance
     *
     * @return boolean True if delete succeeds, false otherwise
     */
    public function delete()
    {
        return $this->proxy()->delete();
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     *
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (property_exists($this, '_'.$name)) {
            $method = 'get'.ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: '.$name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString()
    {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Chat.V1.InviteInstance '.implode(' ', $context).']';
    }
}