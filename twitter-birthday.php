<?php
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException as HttpClientException;
use GuzzleHttp\Psr7\Request as HttpRequest;
use Symfony\Component\DomCrawler\Crawler;

function getTwitterBirthday($screenName)
{
    $url = 'https://twitter.com/' . $screenName;

    try {
        $client = new HttpClient();
        $request = new HttpRequest('GET', $url, [
            'Accept-Language' => 'ja-jp',
        ]);
        $response = $client->send($request);
        if ($response->getStatusCode() == 200) {
            $html = (string) $response->getBody();
        } else {
            throw new Exception('status code from twitter is not invalid');
        }
    } catch (HttpClientException $e) {
        throw new ModelException('request to twitter.com error');
    }

    $crawler = new Crawler($html);
    $crawler = $crawler->filter('.ProfileHeaderCard-birthdate .ProfileHeaderCard-birthdateText');
    $dom = $crawler->eq(0);
    $text = trim($dom->text());

    preg_match('/(0?[1-9]|1[012])月(0?[1-9]|[12][0-9]|3[01])日/', $text, $matches);
    if (isset($matches[1]) && isset($matches[2])) {
        $array = [
            'month' => +$matches[1],
            'day' => +$matches[2],
        ];
        return (object) $array;
    } else {
        throw new Exception('cannot find birthday');
    }
}
