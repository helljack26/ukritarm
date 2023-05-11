<? // Search nova poshta city
if($_POST['search']=='1'):
	$text = $_POST['text'];
	$cities = $np->getCities(0,$text);

	
	foreach ($cities['data'] as $city):
		$num = count($city);
		if($num >0){
            if($city['0']['Description']==""){
                $cityName = $city['Description'];
                $codes = $city['Ref'];
            }else{
                $cityName = $city['0']['Description'];
                $codes = $city['0']['Ref'];
            }
            echo "<li class='city_name' code='$codes'>
						$cityName
					</li>";
		}
	endforeach;
	exit;
endif;
?>

<? // Get nova poshta department
if($_POST['sel_city']=='2'): 
    $cities = $np->getWarehouses($_POST['code_city']);

	foreach ($cities['data'] as $city):
?>
<li class="hidden_novaposhta_block_item">
	<? echo($city['CityDescription'] . ' - ' . $city['Description']);?>
</li>
<? endforeach; exit; endif;?>