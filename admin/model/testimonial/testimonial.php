<?php
class ModelTestimonialTestimonial extends Model {
	
	public function addTestimonial($code, $data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "testimonial` SET `title` = '" . $this->db->escape($data['title']) . "',`name` = '" . $this->db->escape($data['name']) . "',`email` = '" . $this->db->escape($data['email']) . "',`rating` = '" . $this->db->escape($data['rating']) . "', `description` = '" . $this->db->escape($data['description']) . "', `status` = '" . $this->db->escape($data['status']) . "'");
	}

	public function getTestimonial() {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "testimonial`");

		return $query->rows;
	}	
	
	public function editTestimonial($module_id, $data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "module` SET `name` = '" . $this->db->escape($data['name']) . "', `setting` = '" . $this->db->escape(json_encode($data)) . "' WHERE `module_id` = '" . (int)$module_id . "'");
	}

	public function deleteTestimonial($module_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "module` WHERE `module_id` = '" . (int)$module_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "layout_module` WHERE `code` LIKE '%." . (int)$module_id . "'");
	}
		
	public function getTestimonials($module_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "testimonial` WHERE `testimonial_id` = '" . (int)$testimonial_id . "'");

		return $query->row;
	}
}
	
	