<?php
class ControllerExtensionModuleTestimonial extends Controller {
    private $error = array();

    public function index() {

        $this->load->language('extension/module/testimonial');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('testimonial/testimonial');

        $this->getList();
    }

    public function add() {

        die('dassadf');

        $this->load->language('extension/module/testimonial');

         $this->document->setTitle($this->language->get('heading_title'));

         $this->load->model('testimonial/testimonial');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->model_testimonial_testimonial->addTestimonial('testimonial', $this->request->post);
           
            

            $this->session->data['success'] = $this->language->get('text_success');


            $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
        }

       

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/testimonial_form', $data));
    }

    protected function getList() {

        $this->load->model('testimonial/testimonial');

        $this->load->language('extension/module/testimonial');

        $results = $this->model_testimonial_testimonial->getTestimonial();

        $data['user_token'] = $this->session->data['user_token'];

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $url = '';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
            );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
            );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/testimonial', 'user_token=' . $this->session->data['user_token'], true)
            );


        $data['add'] = $this->url->link('extension/module/testimonial/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
        $data['delete'] = $this->url->link('extension/module/testimonial/delete', 'user_token=' . $this->session->data['user_token'] . $url, true);

        $data['action'] = $this->url->link('extension/module/testimonial', 'user_token=' . $this->session->data['user_token'], true);
        $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);     
         

         foreach ($results as $result) {
            $data['testimonials'][] = array(
                'testimonial_id'  => $result['testimonial_id'],
                'name'       => $result['name'],
                'email'       => $result['email'],
                'title'     => $result['title'],
                'rating'     => $result['rating'],
                'status'     => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
                'description' => $result['description']
                );
                
            }
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/testimonial', $data));
        }
    }
