<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 13:42
 *
 * Http Request class for standardizing and inititalizing the request
 *
 */

namespace Http {


    /**
     * Class Request
     * @package Http
     */
    class Request
    {
        /** @var string */
        protected $controller;
        /** @var string */
        protected $action;
        /** @var string */
        protected $remoteHost;
        /** @var  string */
        protected $id;
        /** @var array */
        private $urlParts;
        /** @var array */
        protected $params = [];
        protected $body = '';

        /**
         * @var string
         */
        protected $user;

        /**
         * @var string
         */
        protected $password;

        public function __construct()
        {
            $url = $_SERVER['REQUEST_URI'];
            $this->action = $_SERVER['REQUEST_METHOD'];
            $this->urlParts = $this->getUrlParts($url);
            $this->setParsedController();
            $this->setId();
            $this->setParsedParams();
            $this->setUserAndPassword();
        }

        private function setUserAndPassword()
        {
            $this->user = $_SERVER['PHP_AUTH_USER'] ?? '';
            $this->password = $_SERVER['PHP_AUTH_PW'] ?? '';
        }

        private function setId()
        {
            if (!count($this->urlParts)) {
                $this->id = '';
            } else {
                $idString = $this->urlParts[count($this->urlParts) - 1];
                $this->id = preg_replace('/\?' . $_SERVER['QUERY_STRING'] . '/i', '', $idString);
            }
        }

        private function setParsedParams()
        {
            $paramString = $_SERVER['QUERY_STRING'];
            $paramArray = explode('&', $paramString);
            foreach ($paramArray as $item) {
                if (!empty($item)) {
                    $paramset = explode('=', $item);
                    $this->params[$paramset[0]] = $paramset[1];
                }
            }
        }

        private function setParsedController()
        {
            $webKey = array_search('web.php', $this->urlParts);
//            error_log(var_dump($this->urlParts));
            $this->controller = $this->urlParts[$webKey + 1];
            array_splice($this->urlParts, 0, $webKey + 2);
        }

        private function getUrlParts($url): array
        {
            return explode('/', $url);
        }

        /**
         * @return string
         */
        public function getController(): string
        {
            return $this->controller;
        }

        /**
         * @param string $controller
         */
        public function setController(string $controller)
        {
            $this->controller = $controller;
        }

        /**
         * @return string
         */
        public function getAction(): string
        {
            return $this->action;
        }

        /**
         * @param string $action
         */
        public function setAction(string $action)
        {
            $this->action = $action;
        }

        /**
         * @return string
         */
        public function getRemoteHost(): string
        {
            return $this->remoteHost;
        }

        /**
         * @param string $remoteHost
         */
        public function setRemoteHost(string $remoteHost)
        {
            $this->remoteHost = $remoteHost;
        }

        /**
         * @return array
         */
        public function getParams(): array
        {
            return $this->params;
        }

        /**
         * @param array $params
         */
        public function setParams(array $params)
        {
            $this->params = $params;
        }

        /**
         * @return string
         */
        public function getId(): string
        {
            return $this->id;
        }

        /**
         * @return string
         */
        public function getUser(): string
        {
            return $this->user;
        }

        /**
         * @return string
         */
        public function getPassword(): string
        {
            return $this->password;
        }

    }
}