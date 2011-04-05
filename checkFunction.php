<?php

	function checkString($toBeChecked) {	

	$explodeInput = preg_split("/[\.\\n\\r]/", $toBeChecked, null, PREG_SPLIT_NO_EMPTY);		
	
	$stringCount = 0;
	$copyCount = 0;
		
	echo "<table>\n";
	
	for ($i = 0; $i < count($explodeInput); $i++) {	
		
	
		$explodeInput[$i] = trim($explodeInput[$i]);	
	
		//MAX_WORDS check
		if (count(explode(" ", $explodeInput[$i])) > MAX_WORDS-1  ) {		
			
				
			$half = (int)ceil(count($sentence = str_word_count($explodeInput[$i], 1)) / 2); 
				
			$string1 = implode(' ', array_slice($sentence, 0, $half)); 

			$string2 = implode(' ', array_slice($sentence, $half));	
			
			array_push($explodeInput, $string1);
			$explodeInput[$i] = $string2;
					
				
			// as string2
			if (count(explode(" ", $explodeInput[$i])) > MAX_WORDS-1) {
					
				$half = (int)ceil(count($sentence = str_word_count($explodeInput[$i], 1)) / 2); 
				
				$string3 = implode(' ', array_slice($sentence, 0, $half)); 
					
				$string4 = implode(' ', array_slice($sentence, $half));
					
				array_push($explodeInput, $string3);
				$explodeInput[$i] = $string4;					
			}
				
			// as string4
			if (count(explode(" ", $explodeInput[$i])) > MAX_WORDS-1) {
					
				$half = (int)ceil(count($sentence = str_word_count($explodeInput[$i], 1)) / 2); 
					
				$string4 = implode(' ', array_slice($sentence, 0, $half)); 
				
				$string5 = implode(' ', array_slice($sentence, $half));
					
				array_push($explodeInput, $string4);
				$explodeInput[$i] = $string5;					
			}


		} // End MAX_WORDS check	
	

		echo "<tr>\n";
		
		
		// fewer than min_words, not containing quote %22 are checked	
		if (count(explode(" ", $explodeInput[$i])) > MIN_WORDS-1 &&  substr_count($explodeInput[$i], '"') == 0) {						
			
			$stringCount++;
	
			$url = "http://api.search.live.net/xml.aspx?Appid=". API_KEY ."&query=%22" . urlencode($explodeInput[$i]) . "%22&sources=web";		
		
			$viewUrl = "http://www.bing.com/search?q=%22" . urlencode($explodeInput[$i]) . "%22";
			$str = file_get_contents($url);	
		
			$xml = new SimpleXMLElement($str);
		
			$namespaces = $xml->getNamespaces(true);			
			
			$xml->registerXPathNamespace('web', $namespaces["web"]);
			$result = $xml->xpath('//web:Total');
			
			$instanceCount = $result[0][0];		
				
	
			if ($instanceCount == 0) {	 
					
					echo "<td class='green'>PASS [".'<a href="' . $viewUrl . '" target = "_blank">Bing</a>'.
					"]</td><td>$explodeInput[$i]</td>";		
					
			}
			if ($instanceCount > 0) {
		
					$copyCount++;
					echo "<td class='red'>FAIL [".'<a href="' . $viewUrl . '" target = "_blank">Bing</a>'.
					"]</td><td>$explodeInput[$i]</td>";		
			}	
			
		
		} // end MIN_WORDS and quotation check
		else {   
			echo "<td class='yellow'>SKIPPED[<a href='#footnote'>*</a>]</td><td>$explodeInput[$i]</td>";
		}
		echo "</tr>\n";
	} 
		
	echo("</table>\n");	
	echo('<br />Suspicious found: ' . $copyCount );
	echo('<br />String checked: ' . $stringCount );
	
	if ($copyCount == 0) {
		
		echo('<br /><b>All text within parameters appears to be entirely original.</b>');
		
	} // end if ($copyRatio < 0.2)
	
	if ($copyCount > 0) {
		
		$copyRatio = ($copyCount / $stringCount);
		
		printf("<br />Ratio: %.3f <br/>" , $copyRatio);		
		
		if ($copyRatio < 0.2) {
			
			echo('<b>Probably legit.</b>');
			
		} // end if ($copyRatio < 0.2) 
		
		if ($copyRatio >= 0.2) {
	
			echo('<b>Someone may need a lesson in ethics.</b>');
			
		} // end if ($copyRatio >= 0.2) 
		
	} // end if ($copyCount > 0) 
	

	echo('<br /><br />');
	
	echo('<a href="index.php">Back to form.</a>');
		

}
?>

