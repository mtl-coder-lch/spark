<?php

namespace App\Components\Request;

interface RequestInterface
{
    /**
     * @return mixed
     */
    public function getRequestMethod();

    /**
     * @return mixed
     */
    public function getUri();

    /**
     * @return mixed
     */
    public function getUserAgent();

    /**
     * @return mixed
     */
    public function getServerName();

    /**
     * @return mixed
     */
    public function getAcceptCharset();

    /**
     * @return mixed
     */
    public function getAcceptEncoding();

    /**
     * @return mixed
     */
    public function getHost();

    /**
     * @return mixed
     */
    public function getReferer();

    /**
     * @return false|string
     */
    public function getBody();

    /**
     * @return Attribute
     */
    public function getQuery();

    /**
     * @return Attribute
     */
    public function getPost();

    /**
     * @return mixed
     */
    public function getCookies();
}
