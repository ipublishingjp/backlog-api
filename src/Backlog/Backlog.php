<?php

namespace Itigoppo\BacklogApi\Backlog;

use Itigoppo\BacklogApi\Connector\Connector;
use Itigoppo\BacklogApi\Exception\BacklogException;

/**
 * Class Backlog
 *
 * @package Itigoppo\BacklogApi\Backlog
 *
 * @property Space $space
 * @property Users $users
 * @property Groups $groups
 * @property Projects $projects
 * @property Issues $issues
 * @property Wikis $wikis
 * @property Notifications $notifications
 * @property Git $git
 * @property Watchings $watchings
 */
class Backlog
{
    /** @var Connector */
    protected $connector;

    /** @var null|Space */
    protected $_space;

    /** @var null|Users */
    protected $_users;

    /** @var null|Groups */
    protected $_groups;

    /** @var null|Projects */
    protected $_projects;

    /** @var null|Issues */
    protected $_issues;

    /** @var null|Wikis */
    protected $_wikis;

    /** @var null|Notifications */
    protected $_notifications;

    /** @var null|Git */
    protected $_git;

    /** @var null|Watchings */
    protected $_watchings;

    public function __construct($connector)
    {
        $this->connector = $connector;
    }

    /**
     * 状態一覧の取得
     *
     * @return mixed|string
     * @deprecated プロジェクトごとになりました('19/10/18) @link $backlog->projects->statuses($project_id_or_key)
     */
    public function statuses()
    {
        return $this->connector->get('statuses');
    }

    /**
     * 完了理由一覧の取得
     *
     * @return mixed|string
     */
    public function resolutions()
    {
        return $this->connector->get('resolutions');
    }

    /**
     * 優先度一覧の取得
     *
     * @return mixed|string
     */
    public function priorities()
    {
        return $this->connector->get('priorities');
    }

    /**
     * スターの追加
     *
     * @param  array  $form_options
     * @return mixed|string
     */
    public function addStar(array $form_options = [])
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $form_params = [
            ] + $form_options;

        return $this->connector->post('stars', $form_params, [], $headers);
    }

    /**
     * Magic getter
     *
     * @param  string  $name
     * @return mixed
     * @throws BacklogException
     */
    public function __get(string $name)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        throw new BacklogException('Unknown method ' . $name);
    }

    /**
     * Access the space
     *
     * @return Space|null
     */
    protected function getSpace(): ?Space
    {
        if (!$this->_space) {
            $this->_space = new Space($this->connector);
        }

        return $this->_space;
    }

    /**
     * Access the users
     *
     * @return Users|null
     */
    protected function getUsers(): ?Users
    {
        if (!$this->_users) {
            $this->_users = new Users($this->connector);
        }

        return $this->_users;
    }

    /**
     * Access the groups
     *
     * @return Groups|null
     */
    protected function getGroups(): ?Groups
    {
        if (!$this->_groups) {
            $this->_groups = new Groups($this->connector);
        }

        return $this->_groups;
    }

    /**
     * Access the projects
     *
     * @return Projects|null
     */
    protected function getProjects(): ?Projects
    {
        if (!$this->_projects) {
            $this->_projects = new Projects($this->connector);
        }

        return $this->_projects;
    }

    /**
     * Access the issues
     *
     * @return Issues|null
     */
    protected function getIssues(): ?Issues
    {
        if (!$this->_issues) {
            $this->_issues = new Issues($this->connector);
        }

        return $this->_issues;
    }

    /**
     * Access the wikis
     *
     * @return Wikis|null
     */
    protected function getWikis(): ?Wikis
    {
        if (!$this->_wikis) {
            $this->_wikis = new Wikis($this->connector);
        }

        return $this->_wikis;
    }

    /**
     * Access the notifications
     *
     * @return Notifications|null
     */
    protected function getNotifications(): ?Notifications
    {
        if (!$this->_notifications) {
            $this->_notifications = new Notifications($this->connector);
        }

        return $this->_notifications;
    }

    /**
     * Access the git
     *
     * @return Git|null
     */
    protected function getGit(): ?Git
    {
        if (!$this->_git) {
            $this->_git = new Git($this->connector);
        }

        return $this->_git;
    }

    /**
     * Access the watchings
     *
     * @return Watchings|null
     */
    protected function getWatchings(): ?Watchings
    {
        if (!$this->_watchings) {
            $this->_watchings = new Watchings($this->connector);
        }

        return $this->_watchings;
    }
}
