<?php

//namespace letjson;

/**
 * @param $url
 * @param null $callback
 * @param false $associative
 * @return false|mixed|string
 *
 * @throws Exception
 */
function let_json($url, $callback = null, $associative = false)
{
    if (empty($url)){
        throw new Exception("Url: " . $url . " is empty");
    }

    if (!file_exists($url)) {
        throw new Exception("Url: " . $url . " not exist");
    }
    $file = file_get_contents($url, true);
    $json = json_decode($file, $associative);

    if (is_callable($callback)) {
        $callback($json);
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