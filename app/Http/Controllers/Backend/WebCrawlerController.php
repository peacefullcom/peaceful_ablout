<?php
/**
 * ClassName: WebCrawlerController
 * 网络爬虫控制器
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

use App\Models\Admin;
use App\Models\ResCate;
use App\Models\ResGood;

use App\Library\ImageUpload;

class WebCrawlerController extends Controller
{  
    public function __construct()
    {  
         
    }
//select g.name, g.name_en, g.price, g.img , c.name from peaceful_res_goods as g left join peaceful_res_cate as c on g.cate_id = c.id where g.res_id = 14518
    /**
     * 首页
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
    $json = '';
    $json1 = '';

    $arr = json_decode($json, true);
    $arr1 = json_decode($json1, true);
    foreach ($arr as $k => $v) {
        ResGood::create([
            'id' => $v['goodsId'],
            'res_id' => $v['restaurantId'],
            'cate_id' => $v['categoryId'],
            'name' => $v['name'],
            'name_en' => $arr1[$k]['name'],
            'price' => $v['price'],
            'img' => $v['photo'],
        ]);

        /*
        echo $v['name'].'|'.$arr1[$k]['name'].'<br/>';
        echo $v['photo'];
        */
    }
    echo 'success';
  }

    /**
     * 分类
     * @param Request $request
     * @return mixed
     */
    public function index2(Request $request)
    {
      $json = '';
      $json1 = '';


      $arr = json_decode($json, true);
      $arr1 = json_decode($json1, true);
      foreach ($arr as $k => $v) {
          $id = ResCate::create([
              'id' => $v['id'],
              'res_id' => $v['restaurantId'],
              'name' => $v['name'],
              'name_en' => $arr1[$k]['name'],
          ])->id;
          echo $id;
      }
      echo 'success';
    }

    public function index1(Request $request) {

        $headers = [
         'user-agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36',
        ];
        $client = new Client([
            'timeout' => 60,
            'headers' => $headers
        ]);


        $response = $client->request('GET', 'https://qmenu.us/#/pink-pearl-chinese-seafood-restaurant-vancouver/menu/1582958310115/details');

        echo $response->getStatusCode(); // 200
        echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
        $contents = $response->getBody()->getContents();
       
        //print_r($contents);
        
        //$contents = file_get_contents('https://www.fantuanorder.com/');
        $crawler = new Crawler();
        $crawler->addHtmlContent($contents);
        $data = [];
        try{
            $data = $crawler->filterXPath("//div[@role]")->text();
            echo '1';
        } catch (\Exception $e) {
            echo '0';
        }
        //$contents = file_get_contents('https://www.fantuanorder.com/');
     /*
        $fp = fopen('data.txt', 'w');//opens file in write-only mode  
        fwrite($fp, $contents);  
        fclose($fp); 
        */
        
        var_dump($data);
    }
}