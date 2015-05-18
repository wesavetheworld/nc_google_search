<?php namespace nc;

class GoogleSiteSearch{

	const CLIENT 				= 'google-csbe';

	const QUERY_BASE 			= 'http://www.google.com/search?';
	const QUERY_START_INDEX 	= 'start=%d&';
	const QUERY_RESULTS_COUNT 	= 'num=%d&';
	const QUERY_TERM			= 'q=%s&';
	const QUERY_CLIENT			= 'client=%s&';
	const QUERY_OUPUT			= 'output=%s&';
	const QUERY_CLIENT_ID		= 'cx=%s';

	private $search_term;
	private $results_count;
	private $start_index;
	private $ouput_type;
	private $client_ID;
	private $search_results;
	
	private function convert_search_spaces($search_term){
		return str_replace(" ", "+", $search_term);
	}
	
	private function build_query(){
		$query = self::QUERY_BASE;
		$query .= sprintf(self::QUERY_START_INDEX, $this->start_index);
		$query .= sprintf(self::QUERY_RESULTS_COUNT, $this->results_count);
		$query .= $this->convert_search_spaces(sprintf(self::QUERY_TERM, $this->search_term));
		$query .= sprintf(self::QUERY_CLIENT, self::CLIENT);
		$query .= sprintf(self::QUERY_OUPUT, $this->output_type);
		$query .= sprintf(self::QUERY_CLIENT_ID, $this->client_ID);
		return $query;
	}
	
	private function execute_search(){
		
		$query = $this->build_query();
		
		$ch = curl_init($query);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$this->search_results = simplexml_load_string(curl_exec($ch));
		curl_close($ch);
		
	}
	
	public function __construct($search_term, $results_count, $start_index, $client_ID, $output_type = 'xml_no_dtd') {
		$this->search_term 		= $search_term;
		$this->results_count 	= $results_count;
		$this->start_index 		= $start_index;
		$this->client_ID		= $client_ID;
		$this->output_type		= $output_type;
		$this->execute_search();
	}
	
	public function get_results(){
		$html = '<ul>';
		
		foreach($this->search_results->RES->R as $result){
			$title 	= $result->T;
			$url 	= $result->U;
			$desc	= $result->S;
			
			$html  .= "<li><a href='{$url}'>{$title}</a> - {$desc}</li>";
		}
		
		$html .= '</ul>';
		
		return $html;
	}
	
	

}

?>
