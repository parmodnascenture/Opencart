<?php
class ControllerExtensionModuleTestimonial extends Controller {
    private $error = array();

    public function index() {

        $this->load->language('extension/module/testimonial');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/module');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            if (!isset($this->request->get['module_id'])) {
//echo "<pre>"; print_r($this->request->get); die;

                $this->model_setting_module->addModule('testimonial', $this->request->post);
            } else {
                $this->model_setting_module->editModule($this->request->get['module_id'], $this->request->post);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['title'])) {
            $data['error_name'] = $this->error['title'];
        } else {
            $data['error_name'] = '';
        }

        if (isset($this->error['description'])) {
            $data['error_description'] = $this->error['description'];
        } else {
            $data['error_description'] = '';
        }

        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = '';
        }

        if (isset($this->error['email'])) {
            $data['error_email'] = $this->error['email'];
        } else {
            $data['error_email'] = '';
        }
        if (isset($this->error['rating'])) {
            $data['error_rating'] = $this->error['rating'];
        } else {
            $data['error_rating'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
        );

        if (!isset($this->request->get['testimonial_id'])) {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('extension/module/testimonial', 'user_token=' . $this->session->data['user_token'], true)
            );
        } else {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('extension/module/testimonial', 'user_token=' . $this->session->data['user_token'] . '&testimonial_id=' . $this->request->get['testimonial_id'], true)
            );
        }

        if (!isset($this->request->get['testimonial_id'])) {
            $data['action'] = $this->url->link('extension/module/testimonial', 'user_token=' . $this->session->data['user_token'], true);
        } else {
            $data['action'] = $this->url->link('extension/module/testimonial', 'user_token=' . $this->session->data['user_token'] . '&testimonial_id=' . $this->request->get['testimonial_id'], true);
        }

        $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

        if (isset($this->request->get['testimonial_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $module_info = $this->model_setting_module->getTestimonial($this->request->get['testimonial_id']);
            echo "<pre>";
            print_r($module_info);
            die;
        }

        if (isset($this->request->post['title'])) {
            $data['title'] = $this->request->post['title'];
        } elseif (!empty($module_info)) {
            $data['title'] = $module_info['title'];
        } else {
            $data['title'] = '';
        }

        if (isset($this->request->post['testimonial_id'])) {
            $data['testimonial_id'] = $this->request->post['testimonial_id'];
        } elseif (!empty($module_info)) {
            $data['testimonial_id'] = $module_info['testimonial_id'];
        } else {
            $data['testimonial_id'] = '';
        }

        if (isset($this->request->post['description'])) {
            $data['description'] = $this->request->post['description'];
        } elseif (!empty($module_info)) {
            $data['description'] = $module_info['description'];
        } else {
            $data['description'] = '';
        }

       

        if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } elseif (!empty($module_info)) {
            $data['name'] = $module_info['name'];
        } else {
            $data['name'] = '';
        }

        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } elseif (!empty($module_info)) {
            $data['email'] = $module_info['email'];
        } else {
            $data['email'] = '';
        }

        if (isset($this->request->post['rating'])) {
            $data['rating'] = $this->request->post['rating'];
        } elseif (!empty($module_info)) {
            $data['rating'] = $module_info['rating'];
        } else {
            $data['rating'] = '';
        }

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($module_info)) {
            $data['status'] = $module_info['status'];
        } else {
            $data['status'] = '';
        }
        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($module_info)) {
            $data['status'] = $module_info['status'];
        } else {
            $data['status'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/testimonial', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/testimonial')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        

        if (!$this->request->post['name']) {
            $this->error['name'] = $this->language->get('error_name');
        }

        if (!$this->request->post['email']) {
            $this->error['email'] = $this->language->get('error_email');
        }

        if (!$this->request->post['rating']) {
            $this->error['rating'] = $this->language->get('error_rating');
        }


        return !$this->error;
    }
}