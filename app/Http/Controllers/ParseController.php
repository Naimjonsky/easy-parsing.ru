<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\News;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log as SystemLog;

class ParseController extends Controller
{
    const NEWS_URL = 'http://static.feed.rbc.ru/rbc/logical/footer/news.rss';

    private $pageTitle = 'Парсинг сайта';

    public function parseNews()
    {
        try {
            // http request and response data from URL
            $response = Http::get($this::NEWS_URL);
            if (200 !== $response->status()) {
                throw new \Exception('HTTP status is fail!');
            }

            // reading rss data from http response
            $rssData = simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
            if (!$rssData) {
                throw new \Exception('Couldn\'t read rss data!');
            }

            $newsData = [];
            $index = 0;
            foreach ($rssData->channel->item as $data) {
                $newsData[$index]['guid'] = $data->guid;
                $newsData[$index]['title'] = $data->title;
                $newsData[$index]['link'] = $data->link;
                $newsData[$index]['description'] = $data->description;
                $newsData[$index]['published_at'] = date('Y-m-d H:i:s', strtotime($data->pubDate));
                $newsData[$index]['author'] = $data->author;
                $newsData[$index]['image'] =
                    (isset($data->enclosure) && false !== strpos($data->enclosure['type'], 'image'))
                        ? $data->enclosure['url']
                        : null;

                $index++;
            }

            // logging request
            $this->logRequest($response, $this::NEWS_URL);
            if ($index) {
                News::upsert($newsData, ['guid'], ['author', 'image']);
            }

            $success = 'Парсинг завершен. ';
            $message = 'Для просмотра результата можете перейти на ссылку ';
            $message .= '<a href="' . route('news') . '">Новости</a>';

            return view('pages.parse', [
                'title' => $this->pageTitle,
                'success' => $success,
                'message' => $message,
            ]);

        } catch (\Exception $exception) {
            $log = 'Error on parsing site. Error detected in file ' . $exception->getFile();
            $log .= ' on line ' . $exception->getLine();
            SystemLog::error($log, [$exception->getMessage()]);

            $error = 'Парсинг завершился неудачно! ';
            $message = 'К сожалению что-то пошло не так. Для устранения этой ошибки обратитесь к администратору сайта.';

            return view('pages.parse', [
                'title' => $this->pageTitle,
                'error' => $error,
                'message' => $message,
            ]);
        }
    }

    /**
     * @param Response $response
     * @param string $URL
     * @param string $method
     * @return bool
     */
    private function logRequest(Response &$response, $URL, $method = 'GET')
    {
        return Log::create([
            'created_at' => now(),
            'request_method' => $method,
            'request_url' => $URL,
            'response_http_code' => $response->status(),
            'response_body' => $response->body()
        ]);
    }
}
