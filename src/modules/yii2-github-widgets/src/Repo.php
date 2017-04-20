<?php

namespace dmstr\widgets\github;

use Github\Client;
use Github\HttpClient\Listener\AuthListener;
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
        $client = new \Github\Client(new \Github\HttpClient\CachedHttpClient(['cache_dir' => '/app/runtime/github-api-cache']));
        #$client->authenticate('XXXX',null,Client::AUTH_HTTP_TOKEN);

        $cache = \Yii::$app->cache;

        $key = __NAMESPACE__.':repo:show:'.$this->vendor.'/'.$this->name;
        $this->info = $cache->getOrSet($key, function () use ($client) {
            return $client->api('repo')->show($this->vendor, $this->name);
        });

        $key = __NAMESPACE__.':repo:releases:'.$this->vendor.'/'.$this->name;
        $this->release = $cache->getOrSet($key, function () use ($client) {
            return $client->api('repo')->releases()->latest($this->vendor, $this->name);
        });

        \Yii::trace($this->info, __METHOD__);
        \Yii::trace($this->release, __METHOD__);
    }

    public function run()
    {
        return $this->render('repo.twig', ['repo' => $this]);
    }
}