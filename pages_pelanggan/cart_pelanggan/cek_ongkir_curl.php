<?php
	// $kota_asal = $_POST['kota_asal'];
	$kota_tujuan = $_POST['kota_tujuan'];
	$kurir = $_POST['kurir'];
	$berat = $_POST['berat']*1000;

	// default_origin adalah variabel untuk menyimpan id kota Medan, Sumatera Utara (278)
	$default_origin = 278;

	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "origin=".$default_origin."&destination=".$kota_tujuan."&weight=".$berat."&courier=".$kurir."",
	  CURLOPT_HTTPHEADER => array(
	    "content-type: application/x-www-form-urlencoded",
	    "key: 6fea123080e0aa893b59fc5216384924"
	  ),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	$data = json_decode($response, true);

	$kurir=$data['rajaongkir']['results'][0]['name'];
	$kotaasal=$data['rajaongkir']['origin_details']['city_name'];
	$provinsiasal=$data['rajaongkir']['origin_details']['province'];

	$kotatujuan=$data['rajaongkir']['destination_details']['city_name'];
	$provinsitujuan=$data['rajaongkir']['destination_details']['province'];

	$berat=$data['rajaongkir']['query']['weight']/1000;

?>



		  <table width="100%" class="mx-1 table-responsive">
		    <tr class="text-muted">
		      <td class="w-25">Dari : </td>
		      <td class="w-75" id="txtKotaAsal"><?=$kotaasal.", ".$provinsiasal?></td>
		    </tr>
		    <tr class="text-muted">
		      <td class="w-25">Tujuan : </td>
		      <td class="w-75" id="txtKotaTujuan"><?=$kotatujuan.", ".$provinsitujuan?></td>
		    </tr>
		    <tr class="text-muted">
		      <td class="w-25">Berat : </td>
		      <td class="w-75" id="txtBeratPengiriman"><?=$berat?> Kg</td>
		    </tr>
		  </table>

		  <table class="table table-striped table-bordered table-responsive">
		  	<thead class="text-center">
		  		<tr>
		  			<th>Layanan</th>
		  			<th>Tarif</th>
		  			<th>Estimasi</th>
					  <th></th>
		  		</tr>
		  	</thead>
		  	<tbody>
				
		  		<?php
		  			foreach ($data['rajaongkir']['results'][0]['costs'] as $value) {
						echo "<tr id='dataLayanan'>";
						echo "
							<td class='text-left' id='txtLayananKurir'>".$value['service']."</td>
						";

		  				foreach ($value['cost'] as $tarif) {
		  					echo "<td class='text-left' id='txtTarifKurir'>Rp. " . number_format($tarif['value'],0,',','.')."</td>";
		  					echo "<td id='txtEstimasiPengiriman'>".$tarif['etd']." Hari</td>";
							echo "
								<td>
									<input type='radio' name='rdTarifLayanan' id='rdTarifLayanan' class='form-check-input' title='Rp. $tarif[value]' value='$tarif[value]' onclick='javascript:funcCekOngkir(); javascript:funcGetDataOngkir();' oncheck=''>
									<input type='hidden' name='txtEstimasiPengiriman' value='$tarif[etd]'>
									<input type='hidden' name='txtLayananKurir' value='$value[service]'>
									</td>
							";
							
		  				}
		  				
		  				echo "</tr>";
					
		  			}
		  		?>
				  
		  	</tbody>
		  </table>