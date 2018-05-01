import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Modal, Button } from 'react-bootstrap';


class Loader extends Component {

    constructor(props, context) {
        super(props, context);
    
        this.handleShow = this.handleShow.bind(this);
        this.handleClose = this.handleClose.bind(this);
    
        this.state = {
          show: false,
          hideLoader: true,
          hideMessage: false,
          hideErrorMessage: true,
          yadda: 'yadda yadda yadda'
        };
      }
    
      handleClose() {
        this.setState(
            { 
            show: false 
          
            }
          );
      }
    
      handleShow() {
        this.setState({ show: true });
      }


    render() {
        return (
            <div>
            <Button bsStyle="primary" bsSize="large" onClick={this.handleShow}>
              Launch Modal
            </Button>
    
            <Modal 
            keyboard="true"
            show={this.state.show} onHide={this.handleClose}>
              <Modal.Header closeButton>
                <Modal.Title>Generating Quizzes</Modal.Title>
              </Modal.Header>
              <Modal.Body className="modal-body">
                {!this.state.hideLoader && <div className="loader"></div>}
                {!this.state.hideMessage && <div className="message">Success!</div>}
                {!this.state.hideErrorMessage && <div className="error"></div>}
              </Modal.Body>
              <Modal.Footer>
                <Button onClick={this.handleClose}>{this.state.yadda}</Button>
              </Modal.Footer>
            </Modal>
          </div>
        );
    }
}

export default Loader;

if (document.getElementById('loader')) {
    ReactDOM.render(<Loader />,document.getElementById('loader'));
}