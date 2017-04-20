<?php

namespace dmstr\widgets\github;

use dmstr\web\EmojifyJsAsset;
use Github\Client;
use yii\base\Widget;

/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2016 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Repo extends Widget
{
    public $vendor;
    public $name;
    public $info;
    public $release;
    public $showDownload;
    public $textHtml;

    public function init()
    {
        $release = 'n/a';
        $token = \Yii::$app->settings->getOrSet('apiToken', 'NOT_SET', 'github', 'string');
        $cache = \Yii::$app->cache;

        $client = new Client(new \Github\HttpClient\CachedHttpClient(['cache_dir' => '/app/runtime/github-api-cache']));
        $client->authenticate($token,null,Client::AUTH_HTTP_TOKEN);

        $key = __NAMESPACE__.':repo:show:'.$this->vendor.'/'.$this->name;
        $this->info = $cache->getOrSet(
            $key,
            function () use ($client) {
                return $client->api('repo')->show($this->vendor, $this->name);
            },
            3600
        );

        $key = __NAMESPACE__.':repo:releases:'.$this->vendor.'/'.$this->name;
        $this->release = $cache->getOrSet(
            $key,
            function () use ($client) {
                return $client->api('repo')->releases()->latest($this->vendor, $this->name);
            },
            3600
        );

        \Yii::trace($this->info, __METHOD__);
        \Yii::trace($this->release, __METHOD__);
    }

    public function run()
    {
        EmojifyJsAsset::register($this->view);
        return $this->render('repo.twig', ['repo' => $this]);
    }
}