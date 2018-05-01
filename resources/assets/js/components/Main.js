import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import GenerateItems from './GenerateItems';
import { Modal, Button } from 'react-bootstrap';

class Main extends Component {

    constructor(props, context) {
      super(props, context);
      this.state = {
        items: [],
        show: false,
        hideLoader: false,
        hideSuccess: true,
        hideError: true
      };

      this.handleGenerateItem = this.handleGenerateItem.bind(this);
      this.handleShow = this.handleShow.bind(this);
      this.handleClose = this.handleClose.bind(this);
    }

    handleClose() {
      this.setState(
        { 
          show: false,
          hideLoader: false,
          hideSuccess:true,
          hideError:true
        }
      );
    }
  
    handleShow() {
      this.setState({ show: true });
    }

    handleSuccessMessage() {
      this.setState({
        hideLoader: true,
        hideSuccess:false,
        hideError:true
      });
    }

    handleErrorMessage() {
      this.setState({
        hideLoader: true,
        hideSuccess:true,
        hideError:false
      });
    }

    handleGenerateItem(item) {
      
      let generate_items_form = new FormData();
      generate_items_form.append('question_type',item.question_type);
      generate_items_form.append('num_items',item.num_items);
      generate_items_form.append('job_directory',item.job_directory);
      generate_items_form.append('question_type',item.question_type);

      if (item.question_type == 'tf') {
        this.handleShow();
        fetch('api/generate_tfs',
        {
          method: 'POST',
          body: generate_items_form,
        })
      .then( (response) => {
        if (response.status == 200) {
          let log_jobs_data = {
            jobName: item.job_name,
            jobDescription: item.job_description,
            jobUrl: item.job_directory,
            jobType: item.question_type
          };

          fetch('api/job', 
          {
            method: 'POST',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(log_jobs_data)
          })
          .then( (response) => {
            this.handleSuccessMessage();
            return response.json();
          })
          .catch( (error) => {
            this.handleErrorMessage();
            console.log(error);
          });
        } else {
          this.handleErrorMessage();
        }
      })
      .catch( (error) => {
        this.handleErrorMessage();
        console.log(error);
      });
      // CS602
      } else if (item.question_type == 'single') {
        this.handleShow();
        fetch('api/generate_sss',
        {
          method: 'POST',
          body: generate_items_form,
        })
        .then( (response) => {
          if (response.status == 200) {
            let log_jobs_data = {
              jobName: item.job_name,
              jobDescription: item.job_description,
              jobUrl: item.job_directory,
              jobType: item.question_type
            };

            fetch('api/job',
            {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(log_jobs_data)
            })
            .then( (response) => {
              this.handleSuccessMessage();
              return response.json();
            })
            .catch( (error) => { 
              this.handleErrorMessage();
              console.log(error)
            });
          } else {
            this.handleErrorMessage();
          }
        })
        .catch( (error) => { 
          this.handleErrorMessage();
          console.log(error) 
      });  
      // END CS602
      } else {
        this.handleShow();
        fetch('api/generate_mcs',
        {
          method: 'POST',
          body: generate_items_form,
        })
        .then( (response) => {
          if (response.status == 200) {
            let log_jobs_data = {
              jobName: item.job_name,
              jobDescription: item.job_description,
              jobUrl: item.job_directory,
              jobType: item.question_type
            };

            fetch('api/job',
            {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(log_jobs_data)
            })
            .then( (response) => {
              this.handleSuccessMessage();
              return response.json();
            })
            .catch( (error) => {
              this.handleErrorMessage();
              console.log(error) 
            });
          } else {
            this.handleErrorMessage();
          }
        })
        .catch( (error) => { 
          this.handleErrorMessage();
          console.log(error);
         });
      }
    }

    render() {
        return (
            <div className="scrivener-body">
            <h2 className="header" id="scrivener-welcome">Welcome to Quizster</h2>
              <p className="main-text">
                Quizster is a quiz generator. Fill out the following form completely, and Quizster
                will whip up a quiz with dispatch.
              </p>
              <GenerateItems generate={this.handleGenerateItem} />
              <Modal keyboard
              show={this.state.show} onHide={this.handleClose}>
                <Modal.Header closeButton>
                  <Modal.Title>Generating Quizzes</Modal.Title>
                </Modal.Header>
                <Modal.Body className="modal-body">
                {!this.state.hideLoader && <div className="loader modal-child"></div>}
                {!this.state.hideSuccess && <div className="modal-child">
                        <div className="success modal-message">
                          <p>Success</p>
                        </div>
                </div>}
                {!this.state.hideError && <div className="modal-child">
                        <div className="error modal-message">
                          <p>Error</p>
                        </div>
                </div>}
                </Modal.Body>
                <Modal.Footer>
                  <Button onClick={this.handleClose}>Close</Button>
                </Modal.Footer>
              </Modal>
            </div>
            );
        }
}

export default Main;

if (document.getElementById('root')) {
    ReactDOM.render(<Main />, document.getElementById('root'));
   }
