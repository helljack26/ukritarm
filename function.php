<?
function getCatalogueName() {
    include('includes/config.php');

    $sql = "SELECT catalogue_file_name FROM catalogue";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
		
		return $row['catalogue_file_name'];
    } 
}

function generateProductName($c_product_name , $c_product_articul_name ,$c_product_articul) {
	$is_articul_name = strlen($c_product_articul_name) > 0 ? ", $c_product_articul_name" : '';
	$is_articul_code = strlen($c_product_articul) > 0 ? ", арт. $c_product_articul" : '';

	return $c_product_name . $is_articul_name . $is_articul_code;
}

function addSpaceForThousands($raw_num) {
	$raw_num = str_replace(" ", "", $raw_num);
	$raw_num = intval($raw_num);
	return number_format($raw_num, 0, '.', ' ');
}

function removeSpaceForThousands($raw_num) {
	return number_format($raw_num, 0, '.', '');
}

function correctMysqlDate($raw_date) {
	$explodedDate = explode(' ', $raw_date);
	$date = explode('-', $explodedDate[0]);
	$cleanDate = array_reverse($date);
	return implode('.', $cleanDate);
}

// Using on static page echo titile
// In the page information all info
function getTitleGoogle() {
    include('includes/config.php');
    $base_url = strtok($_SERVER['REQUEST_URI'], '?');
    $trim_base_url = trim($base_url, '/');
	
	$search = 'search-result';
	if(preg_match("/{$search}/i", $trim_base_url)) {
		$trim_base_url = 'search-result';
	}

    $sql = "SELECT name_page, title, content, image, soc_info_description, title_google 
			FROM social_page_content 
			WHERE name_page='$trim_base_url' 
			LIMIT 1
			";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $title = $row["title"];
        $content = $row["content"];
        $image = $row["image"];
        $soc_info_description = $row["soc_info_description"];
        $title_google = $row["title_google"];
    } else {
        $title = "";
        $content = "";
        $image = "";
        $soc_info_description = "";
        $title_google = "";
    }
    $data = array(
        'base_url' => $base_url,
        'title' => $title,
        'content' => $content,
        'image' => $image,
        'soc_info_description' => $soc_info_description,
        'title_google' => $title_google
    );
    return $data;
}
// END

function getPidFromProductNameAndChar() {
	include('admin/product_array.php');

	$url_parts = explode('/', $_SERVER['REQUEST_URI']);
	
	$product_url_name = $url_parts[2];
	$product_url_articul = isset($url_parts[3]) ? $url_parts[3] : '';
	
	$pid = '';
	$articul_transliterate = '';
	$articul = '';
	
	foreach ($products as $product) {
		if ($product['product_name'] == $product_url_name && $product['articul_transliterate'] == $product_url_articul) {
			$pid = $product['pid'];
			$articul_transliterate = $product['articul_transliterate'];
			$articul = $product['articul'];
			return ['pid' => $pid, 'articul_transliterate' => $articul_transliterate, 'articul' => $articul];
		}
	}
	return ['pid' => $pid, 'product_name' => $articul_transliterate, 'articul' => $articul];
}

function generateProductDetailsUrl($product_name , $product_spec) {
	$transName = transliterate($product_name); 
	
	$isProductSpec = strlen($product_spec) > 0 ?  '/'. transliterate($product_spec) : ''; 
	$url = "product-details/$transName$isProductSpec";
	return $url;
}

function show404() {
    include '404.html';
    exit;
}


function getPageContent($con, $id) {
    $getPageContent = mysqli_query($con,"SELECT * from page_content where newid='$id'");
    $rowPageContent = mysqli_fetch_array($getPageContent);
	return unserialize($rowPageContent['text']);
} 

function transliterate($string) {
    $translit = "Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();";
    $string = transliterator_transliterate($translit, $string);
	$string = preg_replace('/[-\s]+/', '-', $string);
	$string = preg_replace ('/[^\p{L}\p{N}]/u', '-', $string);
	$string = str_replace("ʹ", "", $string);
	$string = str_replace('"', "", $string);
	$string = str_replace("Ø", "", $string);
	$string = str_replace("ø", "", $string);
	$string = str_replace("№", "", $string);
	$string = str_replace("°", "", $string);
	$string = str_replace("²", "", $string);

    return trim($string, '-');
}

function removeRootDir(){
	$old = $_GET['dir'];
	$getParamTransName = explode('/',$old);

	return $getParamTransName[count($getParamTransName)-1];
}

function checkIsHttp(){
	if($_SERVER['SERVER_NAME'] == 'ukritarm.local'){
    $protocol = 'http://';
	}else{
    $protocol = 'https://';
	} 
	return $protocol;
}

if(isset($_POST['cart']) && $_POST['cart'] == '1'){
	$id = intval($_POST['id']);
	unset($_SESSION['cart'][$id]);
}
	
if(isset($_POST['cart']) && $_POST['cart'] == 'update'){
    if(isset($_POST['id']) && isset($_POST['quant']) && isset($_POST['tp'])){
        $id = intval($_POST['id']);
        $quat = $_POST['quant'];
        $tp = $_POST['tp'];
        if(isset($_SESSION['cart'])){
            $_SESSION['cart'][$id]['quantity'] = $quat;
            $_SESSION['cart'][$id]['product_unit'] = '11';
        }
    }
}

function replaceDoubleQuote($string) {
	$string = str_replace('"', "'", $string);
	return $string;
}

function quotesToCode($textWithQuotes){
	$textWithoutDoubleQuotes = str_replace('"', "&quot;", $textWithQuotes);
	$textWithoutSingleQuotes = str_replace("'", "&apos;", $textWithoutDoubleQuotes);
	return $textWithoutSingleQuotes;
}

function codeToQuote($textWithQuotes){
	$textWithDoubleQuotes = str_replace('&quot;', '"', $textWithQuotes);
	$textWithSingleQuotes = str_replace("&apos;", "'", $textWithDoubleQuotes);
	return $textWithSingleQuotes;
}

function CategoryName($con,$catId, $scid){
	// Category
	if($catId > 0 && strlen($scid) == 0){
		$getCat=mysqli_query($con,"SELECT categoryName
								from category 
								where id='$catId'
								");
		$rowCat=mysqli_fetch_array($getCat);
		return $rowCat['categoryName'];
	}
	// Subcategory
	if($catId > 0 && strlen($scid) > 0){		
		$getSubcat=mysqli_query($con,"SELECT subcategory 
									from subcategory 
									where subcategory_id='$scid' 
									and categoryid='$catId'
									");
		$rowSubcat=mysqli_fetch_array($getSubcat);		
		return $rowSubcat['subcategory'];
	}
}

function check_mobile_device() { 
    $mobile_agent_array = array('ipad', 'iphone', 'android', 'pocket', 'palm', 'windows ce', 'windowsce', 'cellphone', 'opera mobi', 'ipod', 'small', 'sharp', 'sonyericsson', 'symbian', 'opera mini', 'nokia', 'htc_', 'samsung', 'motorola', 'smartphone', 'blackberry', 'playstation portable', 'tablet browser');
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);    
    // var_dump($agent);exit;
    foreach ($mobile_agent_array as $value) {    
        if (strpos($agent, $value) !== false) return true;   
    }       
    return false; 
}

function footer_name($con,$name){
	$sql = mysqli_query($con,"select $name from footer");
	$row=  mysqli_fetch_array($sql);
	return $row[$name];
}

function download($filename) {
    if (file_exists($filename)) {
		header("Content-Disposition: attachment; filename=" . basename($filename) . ";");
        echo file_get_contents($filename);
    } else{
		echo "Not Found";
	} 
}

function isExistInBasket ($isExistThisCode, $isCharCode) {
	if (isset($_SESSION['cart'])) {

		$isExistInBasket = false;
		foreach($_SESSION['cart'] as $id => $value):
			if($value['pid'] == $isExistThisCode){
				$isExistInBasket = true;  
			}
		endforeach; 
		
		if($isExistInBasket == true){
			return 'Оформити';
		} else {
			return 'Купити';
		}
		
	} else {
		return 'Купити';
	}
}

function cleanName($dirtyName) {
    $cleanTempName = preg_replace('/\((.+?)\)/i', '', $dirtyName);
    $cleanTempName = preg_replace("/[^ a-яа-яё\d]/ui", '', $cleanTempName);
    return $cleanTempName; 
}

function getAverageRating($con,$c_code){

	$getReviews=mysqli_query($con,"SELECT * from productreviews where productId='$c_code'");
	$num=mysqli_num_rows($getReviews);
	$averageRating = 0;
	while($rowRating = mysqli_fetch_array($getReviews)){
		$averageRating += intval($rowRating['value']);
	};
	if($averageRating > 5){
		$averageRating = round($averageRating / $num);
	}
	$result = [];
    $result['averageRating'] = $averageRating;
    $result['num'] = $num;

	return $result;
}

function getAverageRatingStars($averageRating){
    $result = '';

    for ($i = 1; $i < 6 ; $i++) {
        if ($i <= $averageRating) {
            $result .= '<div class="reviews_item_rate_star reviews_item_rate_star_checked"></div>';
        } else {
            $result .='<div class="reviews_item_rate_star"></div>';
        } 
    }

	echo $result;
}


function discountReview($con, $id) {
    $discountReviews=mysqli_query($con,"SELECT * from productreviews where productId='$id'");
    $discountReviewsNum=mysqli_num_rows($discountReviews);
    $averageRating = 0;
    while($rowRatingDiscount = mysqli_fetch_array($discountReviews)){
        $averageRating += intval($rowRatingDiscount['value']);
    };
    $result = [$averageRating , $discountReviewsNum];
    return $result;
} 


function getDiscountPercent ($c_old_price,$c_price){
	$sale = round($c_old_price);
	$price = round($c_price);
	$discount = round((($sale - $price) / $sale) * 100);
	return '-' . abs(round($discount)) . '%';
}
?>