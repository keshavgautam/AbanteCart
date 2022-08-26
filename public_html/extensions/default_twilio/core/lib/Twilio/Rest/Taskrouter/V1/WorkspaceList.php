<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Taskrouter\V1;

use Twilio\ListResource;
use Twilio\Options;
use Twilio\Serialize;
use Twilio\Values;
use Twilio\Version;

class WorkspaceList extends ListResource
{
    /**
     * Construct the WorkspaceList
     *
     * @param Version $version Version that contains the resource
     *
     * @return \Twilio\Rest\Taskrouter\V1\WorkspaceList
     */
    public function __construct(Version $version)
    {
        parent::__construct($version);

        // Path Solution
        $this->solution = array();

        $this->uri = '/Workspaces';
    }

    /**
     * Streams WorkspaceInstance records from the API as a generator stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     *
     * @param array|Options $options  Optional Arguments
     * @param int           $limit    Upper limit for the number of records to return. stream()
     *                                guarantees to never return more than limit.  Default is no
     *                                limit
     * @param mixed         $pageSize Number of records to fetch per request, when not set
     *                                will use the default value of 50 records.  If no
     *                                page_size is defined but a limit is defined, stream()
     *                                will attempt to read the limit with the most
     *                                efficient page size, i.e. min(limit, 1000)
     *
     * @return \Twilio\Stream stream of results
     */
    public function stream($options = array(), $limit = null, $pageSize = null)
    {
        $limits = $this->version->readLimits($limit, $pageSize);

        $page = $this->page($options, $limits['pageSize']);

        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }

    /**
     * Reads WorkspaceInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     *
     * @param array|Options $options  Optional Arguments
     * @param int           $limit    Upper limit for the number of records to return. read()
     *                                guarantees to never return more than limit.  Default is no
     *                                limit
     * @param mixed         $pageSize Number of records to fetch per request, when not set
     *                                will use the default value of 50 records.  If no
     *                                page_size is defined but a limit is defined, read()
     *                                will attempt to read the limit with the most
     *                                efficient page size, i.e. min(limit, 1000)
     *
     * @return WorkspaceInstance[] Array of results
     */
    public function read($options = array(), $limit = null, $pageSize = null)
    {
        return iterator_to_array($this->stream($options, $limit, $pageSize), false);
    }

    /**
     * Retrieve a single page of WorkspaceInstance records from the API.
     * Request is executed immediately
     *
     * @param array|Options $options    Optional Arguments
     * @param mixed         $pageSize   Number of records to return, defaults to 50
     * @param string        $pageToken  PageToken provided by the API
     * @param mixed         $pageNumber Page Number, this value is simply for client state
     *
     * @return \Twilio\Page Page of WorkspaceInstance
     */
    public function page($options = array(), $pageSize = Values::NONE, $pageToken = Values::NONE, $pageNumber = Values::NONE)
    {
        $options = new Values($options);
        $params = Values::of(array(
            'FriendlyName' => $options['friendlyName'],
            'PageToken'    => $pageToken,
            'Page'         => $pageNumber,
            'PageSize'     => $pageSize,
        ));

        $response = $this->version->page(
            'GET',
            $this->uri,
            $params
        );

        return new WorkspacePage($this->version, $response, $this->solution);
    }

    /**
     * Retrieve a specific page of WorkspaceInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     *
     * @return \Twilio\Page Page of WorkspaceInstance
     */
    public function getPage($targetUrl)
    {
        $response = $this->version->getDomain()->getClient()->request(
            'GET',
            $targetUrl
        );

        return new WorkspacePage($this->version, $response, $this->solution);
    }

    /**
     * Create a new WorkspaceInstance
     *
     * @param string        $friendlyName The friendly_name
     * @param array|Options $options      Optional Arguments
     *
     * @return WorkspaceInstance Newly created WorkspaceInstance
     */
    public function create($friendlyName, $options = array())
    {
        $options = new Values($options);

        $data = Values::of(array(
            'FriendlyName'         => $friendlyName,
            'EventCallbackUrl'     => $options['eventCallbackUrl'],
            'EventsFilter'         => $options['eventsFilter'],
            'MultiTaskEnabled'     => Serialize::booleanToString($options['multiTaskEnabled']),
            'Template'             => $options['template'],
            'PrioritizeQueueOrder' => $options['prioritizeQueueOrder'],
        ));

        $payload = $this->version->create(
            'POST',
            $this->uri,
            array(),
            $data
        );

        return new WorkspaceInstance($this->version, $payload);
    }

    /**
     * Constructs a WorkspaceContext
     *
     * @param string $sid The sid
     *
     * @return \Twilio\Rest\Taskrouter\V1\WorkspaceContext
     */
    public function getContext($sid)
    {
        return new WorkspaceContext($this->version, $sid);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString()
    {
        return '[Twilio.Taskrouter.V1.WorkspaceList]';
    }
}