<?php

namespace Itigoppo\BacklogApi\Backlog;

use Itigoppo\BacklogApi\Connector\Connector;

class Space
{
    protected $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * スペース情報の取得
     *
     * @return mixed|string
     */
    public function info()
    {
        return $this->connector->get('space');
    }

    /**
     * 最近の更新の取得
     *
     * @param  int|null  $activity_type_id
     * @param  int|null  $min_id
     * @param  int|null  $max_id
     * @param  int  $count
     * @param  string  $order
     * @return mixed|string
     * @internal param array $params
     */
    public function activities(int $activity_type_id = null, int $min_id = null, int $max_id = null, int $count = 20, string $order = 'desc')
    {
        $query_params = [
            'activityTypeId' => $activity_type_id,
            'minId' => $min_id,
            'maxId' => $max_id,
            'count' => $count,
            'order' => $order,
        ];

        return $this->connector->get('space/activities', $query_params);
    }

    /**
     * スペースのお知らせの取得
     *
     * @return mixed|string
     */
    public function notification()
    {
        return $this->connector->get('space/notification');
    }

    /**
     * スペースのお知らせの更新
     *
     * @param  string  $content
     * @return mixed|string
     */
    public function putNotification(string $content)
    {
        $query_params = [
            'content' => $content,
        ];

        return $this->connector->put('space/notification', $query_params);
    }

    /**
     * スペースの容量使用状況の取得
     *
     * @return mixed|string
     */
    public function diskUsage()
    {
        return $this->connector->get('space/diskUsage');
    }

    /**
     * Post Attachment File
     *
     * @param  array  $multipart
     * @return mixed|string
     * @see https://developer.nulab-inc.com/docs/backlog/api/2/post-attachment-file/
     */
    public function postAttachment(array $multipart)
    {
        return $this->connector->postFile('space/attachment', $multipart);
    }
}
