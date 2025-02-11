<?php

namespace Itigoppo\BacklogApi\Backlog;

use Itigoppo\BacklogApi\Connector\Connector;

class Git
{
    protected $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * Gitリポジトリ一覧の取得
     *
     * @param  string  $project_id_or_key
     * @return mixed|string
     */
    public function repositories(string $project_id_or_key)
    {
        return $this->connector->get(sprintf('projects/%s/git/repositories', $project_id_or_key));
    }

    /**
     * Gitリポジトリの取得
     *
     * @param  string  $project_id_or_key
     * @param  string  $repository_id_or_name
     * @return mixed|string
     */
    public function findRepositories(string $project_id_or_key, string $repository_id_or_name)
    {
        return $this->connector->get(
            sprintf(
                'projects/%s/git/repositories/%s',
                $project_id_or_key,
                $repository_id_or_name
            )
        );
    }

    /**
     * プルリクエスト一覧の取得
     *
     * @param  string  $project_id_or_key
     * @param  string  $repository_id_or_name
     * @param  array  $query_options
     * @return mixed|string
     */
    public function pullRequests(string $project_id_or_key, string $repository_id_or_name, array $query_options = [])
    {
        $query_params = [
            ] + $query_options;

        return $this->connector->get(
            sprintf(
                'projects/%s/git/repositories/%s/pullRequests',
                $project_id_or_key,
                $repository_id_or_name
            ),
            [],
            $query_params
        );
    }

    /**
     * プルリクエスト数の取得
     *
     * @param  string  $project_id_or_key
     * @param  string  $repository_id_or_name
     * @param  array  $query_options
     * @return mixed|string
     */
    public function numberOfPullRequests(string $project_id_or_key, string $repository_id_or_name, array $query_options = [])
    {
        $query_params = [
            ] + $query_options;

        return $this->connector->get(
            sprintf(
                'projects/%s/git/repositories/%s/pullRequests/count',
                $project_id_or_key,
                $repository_id_or_name
            ),
            [],
            $query_params
        );
    }

    /**
     * プルリクエストの追加
     *
     * @param  string  $project_id_or_key
     * @param  string  $repository_id_or_name
     * @param  string  $summary
     * @param  string  $description
     * @param  string  $base_branch
     * @param  string  $merge_branch
     * @param  array  $form_options
     * @return mixed|string
     */
    public function createPullRequests(
        string $project_id_or_key,
        string $repository_id_or_name,
        string $summary,
        string $description,
        string $base_branch,
        string $merge_branch,
        array $form_options = []
    ) {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $form_params = [
                'summary' => $summary,
                'description' => $description,
                'base' => $base_branch,
                'branch' => $merge_branch,
            ] + $form_options;

        return $this->connector->post(
            sprintf(
                'projects/%s/git/repositories/%s/pullRequests',
                $project_id_or_key,
                $repository_id_or_name
            ),
            $form_params,
            [],
            $headers
        );
    }

    /**
     * プルリクエストの取得
     *
     * @param  string  $project_id_or_key
     * @param  string  $repository_id_or_name
     * @param  int  $pull_request_number
     * @return mixed|string
     */
    public function findPullRequest(string $project_id_or_key, string $repository_id_or_name, int $pull_request_number)
    {
        return $this->connector->get(
            sprintf(
                'projects/%s/git/repositories/%s/pullRequests/%d',
                $project_id_or_key,
                $repository_id_or_name,
                $pull_request_number
            )
        );
    }

    /**
     * プルリクエストの更新
     *
     * @param  string  $project_id_or_key
     * @param  string  $repository_id_or_name
     * @param  int  $pull_request_number
     * @param  array  $form_options
     * @return mixed|string
     */
    public function updatePullRequest(
        string $project_id_or_key,
        string $repository_id_or_name,
        int $pull_request_number,
        array $form_options = []
    ) {
        $form_params = [
            ] + $form_options;

        return $this->connector->patch(
            sprintf(
                'projects/%s/git/repositories/%s/pullRequests/%d',
                $project_id_or_key,
                $repository_id_or_name,
                $pull_request_number
            ),
            $form_params
        );
    }

    /**
     * プルリクエストコメントの取得
     *
     * @param  string  $project_id_or_key
     * @param  string  $repository_id_or_name
     * @param  int  $pull_request_number
     * @param  array  $query_options
     * @return mixed|string
     */
    public function pullRequestComments(
        string $project_id_or_key,
        string $repository_id_or_name,
        int $pull_request_number,
        array $query_options = []
    ) {
        $query_params = [
            ] + $query_options;

        return $this->connector->get(
            sprintf(
                'projects/%s/git/repositories/%s/pullRequests/%d/comments',
                $project_id_or_key,
                $repository_id_or_name,
                $pull_request_number
            ),
            [],
            $query_params
        );
    }

    /**
     * プルリクエストコメントの追加
     *
     * @param  string  $project_id_or_key
     * @param  string  $repository_id_or_name
     * @param  int  $pull_request_number
     * @param  string  $content
     * @param  array  $form_options
     * @return mixed|string
     */
    public function createPullRequestComment(
        string $project_id_or_key,
        string $repository_id_or_name,
        int $pull_request_number,
        string $content,
        array $form_options = []
    ) {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $form_params = [
                'content' => $content,
            ] + $form_options;

        return $this->connector->post(
            sprintf(
                'projects/%s/git/repositories/%s/pullRequests/%d/comments',
                $project_id_or_key,
                $repository_id_or_name,
                $pull_request_number
            ),
            $form_params,
            [],
            $headers
        );
    }

    /**
     * プルリクエストコメント数の取得
     *
     * @param  string  $project_id_or_key
     * @param  string  $repository_id_or_name
     * @param  int  $pull_request_number
     * @return mixed|string
     */
    public function numberOfPullRequestComments(string $project_id_or_key, string $repository_id_or_name, int $pull_request_number)
    {
        return $this->connector->get(
            sprintf(
                'projects/%s/git/repositories/%s/pullRequests/%d/comments/count',
                $project_id_or_key,
                $repository_id_or_name,
                $pull_request_number
            )
        );
    }

    /**
     * プルリクエストコメント情報の更新
     *
     * @param  string  $project_id_or_key
     * @param  string  $repository_id_or_name
     * @param  int  $pull_request_number
     * @param  int  $comment_id
     * @param  array  $form_options
     * @return mixed|string
     */
    public function updatePullRequestComment(
        string $project_id_or_key,
        string $repository_id_or_name,
        int $pull_request_number,
        int $comment_id,
        array $form_options = []
    ) {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $form_params = [
            ] + $form_options;

        return $this->connector->patch(
            sprintf(
                'projects/%s/git/repositories/%s/pullRequests/%d/comments/%d',
                $project_id_or_key,
                $repository_id_or_name,
                $pull_request_number,
                $comment_id
            ),
            $form_params,
            [],
            $headers
        );
    }

    /**
     * プルリクエスト添付ファイル一覧の取得
     *
     * @param  string  $project_id_or_key
     * @param  string  $repository_id_or_name
     * @param  int  $pull_request_number
     * @return mixed|string
     */
    public function pullRequestAttachments(string $project_id_or_key, string $repository_id_or_name, int $pull_request_number)
    {
        return $this->connector->get(
            sprintf(
                'projects/%s/git/repositories/%s/pullRequests/%d/attachments',
                $project_id_or_key,
                $repository_id_or_name,
                $pull_request_number
            )
        );
    }
}
