<?php

namespace dmstr\widgets\github;

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
        #var_dump($this->vendor);exit;
        $this->info = $client->api('repo')->show($this->vendor, $this->name);
        \Yii::trace($this->info, __METHOD__);
        $this->release = $client->api('repo')->releases()->latest($this->vendor, $this->name);
        \Yii::trace($this->release, __METHOD__);
    }

    public function run()
    {
        return $this->render('repo.twig', ['repo' => $this]);
    }
}