<?php

namespace App\Components\Request;

class Request implements RequestInterface
{
    private $requestMethod;
    private $uri;
    private $userAgent;
    private $serverName;
    private $acceptEncoding;
    private $host;
    private $body;
    private $cookies;
    private $files;
    private $params;
    public $query;
    public $post;

    public function __construct()
    {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
        $this->serverName = $_SERVER['SERVER_NAME'];
        $this->acceptEncoding = $_SERVER['HTTP_ACCEPT_ENCODING'];
        $this->host = $_SERVER['HTTP_HOST'];
        $this->query = new Attribute('query', $_GET);
        $this->post = new Attribute('post', $_POST);
        $this->cookies = new Attribute('cookies', $_COOKIE);
        $this->files = new Attribute('files', $_FILES);
        $this->body = file_get_contents('php://input');
    }

    /**
     * @return mixed
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @return mixed
     */
    public function getServerName()
    {
        return $this->serverName;
    }

    /**
     * @return mixed
     */
    public function getAcceptCharset()
    {
        return $this->acceptCharset;
    }

    /**
     * @return mixed
     */
    public function getAcceptEncoding()
    {
        return $this->acceptEncoding;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    public function getReferer()
    {
        return $this->referer;
    }

    /**
     * @return false|string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return Attribute
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @return Attribute
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @return mixed
     */
    public function getCookies()
    {
        return $this->cookies;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params): void
    {
        $this->params = $params;
    }

    public function getUriWithRemovedQueryString()
    {
        preg_match('/[A-Za-z0-9\/]+[^\?]/', $this->uri, $matches);
        return $matches[0];
    }
}
