<?php namespace nc;

class GoogleSiteSearch{

	const CLIENT = 'google-csbe';

	const QUERY_BASE 								= 'http://www.google.com/search?';
	const QUERY_START_INDEX 				= 'start=%d';
	const QUERY_RESULTS_COUNT 			= 'num=%d';
	const QUERY_TERM								= 'q=%s';

	private $search_term;
	private $results_count;
	private $start_index;
	private $ouput_type;

	private function build_query(){

	}

	public function __construct($search_term, $results_count, $start_index, $output_type = 'xml_no_dtd') {
		$this->search_term 		= $search_term;
		$this->results_count 	= $results_count;
		$this->start_index 		= $start_index;
		$this->output_type		= $output_type;
	}

	public function get_search_term(){
		return $this->search_term;
	}

	public function get_results_count(){
		return $this->results_count;
	}

	public function get_start_index(){
		return $this->start_index;
	}

	public function get_output_type(){
		return $this->output;
	}

}

?>
