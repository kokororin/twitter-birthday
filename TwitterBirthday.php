<?php
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException as HttpClientException;
use GuzzleHttp\Psr7\Request as HttpRequest;
use Symfony\Component\DomCrawler\Crawler;

class TwitterBirthday implements ArrayAccess
{
    /**
     * birthday array
     *
     * @var array
     */
    private $birthday;

    /**
     * Create a new TwitterBirthday instance.
     *
     * @param  string $screenName
     * @throws Exception
     */
    public function __construct($screenName)
    {
        $url = 'https://twitter.com/' . $screenName;

        try {
            $client = new HttpClient();
            $request = new HttpRequest('GET', $url, [
                'Accept-Language' => 'ja-jp',
            ]);
            $response = $client->send($request, [
                'timeout' => 10,
            ]);
            if ($response->getStatusCode() == 200) {
                $html = (string) $response->getBody();
            } else {
                throw new Exception('status code from twitter is not invalid');
            }
        } catch (HttpClientException $e) {
            throw new Exception('request to twitter.com error');
        }

        $crawler = new Crawler($html);
        $crawler = $crawler->filter('.ProfileHeaderCard-birthdate .ProfileHeaderCard-birthdateText');
        $dom = $crawler->eq(0);
        $text = trim($dom->text());

        preg_match('/(0?[1-9]|1[012])月(0?[1-9]|[12][0-9]|3[01])日/', $text, $matches);
        if (isset($matches[1]) && isset($matches[2])) {
            $this->offsetSet('month', +$matches[1]);
            $this->offsetSet('day', +$matches[2]);
        } else {
            throw new Exception('cannot find birthday');
        }
    }

    /**
     * Get the month for the requested birthday info.
     *
     * @return integer
     */
    public function getMonth()
    {
        return $this->offsetGet('month');
    }

    /**
     * Get the day for the requested birthday info.
     *
     * @return integer
     */
    public function getDay()
    {
        return $this->offsetGet('day');
    }

    /**
     * Whether or not the requested birthday info exists.
     *
     * @param  mixed $offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->birthday[strtolower($offset)]);
    }

    /**
     * Get the information for the requested birthday info.
     *
     * @param  mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->birthday[strtolower($offset)];
    }

    /**
     * Set the given birthday info to be the given value.
     *
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if ($offset == null) {
            $this->birthday[] = $value;
        } else {
            $this->birthday[strtolower($offset)] = $value;
        }
    }

    /**
     * Unset the birthday info at the given offset.
     *
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->birthday[strtolower($offset)]);
    }
}
