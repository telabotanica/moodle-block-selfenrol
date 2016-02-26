<?php
class block_enrolblock extends block_base {

	public function init() {
		$this->title = get_string('block_enrolblock_title', 'enrolblock');
	}

	public function get_content() {
		if ($this->content !== null) {
			return $this->content;
		}
		$this->content  =  new stdClass;
		$this->content->text = $this->generate_content();

		return $this->content;
	}

	protected function generate_content() {
		global $COURSE;
		global $USER;

		$str = "";
		$enrolled = is_enrolled($this->context, $USER);

		if ($enrolled) {
			$unenrol_url  = new moodle_url('/enrol/manual/unenrolself.php', array('id' => $COURSE->id, 'enrolid' => $USER->id));
			$str .= get_string('already_enrolled', 'enrolblock');
			$str .= '<a href="' . $unenrol_url->out() . '">';
			$str .= get_string('unenrol', 'enrolblock');
			$str .= "</a>";
		} else {
			$enrol_url  = new moodle_url('/enrol/index.php', array('id' => $COURSE->id));
			$str .= get_string('not_enrolled_yet', 'enrolblock');
			$str .= '<a href="' . $enrol_url->out() . '">';
			$str .= get_string('enrol_now', 'enrolblock');
			$str .= "</a>";
			$str .= "";
			$str .= "";
		}

		return $str;
	}
}
?>