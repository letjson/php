<?php

//namespace letjson;

/**
 * @param array|string $url
 * @param null $callback
 * @param false $associative
 * @return false|mixed|string
 *
 * @throws Exception
 */
function let_json($url, $callback = null, $associative = false)
{
    if (empty($url)){
        throw new Exception("Url: $url is empty");
    }

    $urls = [];
    if (!is_array($url)){
        $urls[] = $url;
    } else {
        $urls = $url;
    }

    foreach($urls as $url_item){
        if (!file_exists($url_item)) {
            throw new Exception("Url: $url_item not exist");
        }
        $file = file_get_contents($url, true);
        if(count($urls)>1){
            $json[] = json_decode($file, $associative);
        } else {
            $json = json_decode($file, $associative);
        }
    }

    if (is_callable($callback)) {
        return $callback($json);
    }

    return $json;
}


/**
 * Class LetJson
 */
class LetJson
{
    /** @var array|mixed */
    public $json = [];

    /** @var string  */
    public $url = '';

    /**
     * LetJson constructor.
     * @param $url
     */
    function __construct($url)
    {
        $this->url = $url;
        $this->json = let_json($url);
    }

    /**
     * @return mixed
     */
    function first()
    {
        return $this->json[0];
    }

    /**
     * @param $callback
     */
    function each($callback)
    {
        foreach ($this->json as $item) {
            $callback($item);
        }
    }
}
