<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\SearchEngine;

use Illuminate\Support\Collection;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class Optimization.
 */
class Optimization
{
    use Helpers;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $code;

    /**
     * @var \Zs\Foundation\SearchEngine\Meta
     */
    protected $meta;

    /**
     * Optimization constructor.
     */
    public function __construct()
    {
        $this->code = new Collection();
        $this->meta = new Meta();
        $this->code->put('{sitename}', $this->setting->get('seo.title', 'Zs CMS'));
        $this->code->put('{keywords}', $this->setting->get('seo.keyword', 'Zs CMS'));
        $this->code->put('{description}', $this->setting->get('seo.description', 'Zs CMS'));
    }

    /**
     * Get all data or data by key.
     *
     * @param string $key
     *
     * @return \Illuminate\Support\Collection|mixed
     */
    public function getData($key = '')
    {
        $data = $this->meta->getData();
        foreach ($data as $k => $v) {
            $data->put($k, strip_tags(trim(strtr($v, $this->code->toArray()), '-_ ')));
        }
        if ($key) {
            return $data->get($key);
        } else {
            return $data;
        }
    }

    /**
     * Set code.
     *
     * @param $key
     * @param $value
     */
    public function setCode($key, $value)
    {
        $this->code->put($key, $value);
    }

    /**
     * Set custom meta.
     *
     * @param $title
     * @param $description
     * @param $keywords
     */
    public function setCustomMeta($title, $description, $keywords)
    {
        if ($title || $keywords || $description) {
            $this->meta->setTitle($title);
            $this->meta->setDescription($description);
            $this->meta->setKeywords($keywords);
        }
    }

    /**
     * Set title meta.
     *
     * @param $title
     */
    public function setTitleMeta($title)
    {
        $this->meta->setTitle($title);
    }

    /**
     * Set description meta.
     *
     * @param $description
     */
    public function setDescriptionMeta($description)
    {
        $this->meta->setDescription($description);
    }

    /**
     * Set keywords mets.
     *
     * @param $keywords
     */
    public function setKeywordsMeta($keywords)
    {
        $this->meta->setKeywords($keywords);
    }
}
