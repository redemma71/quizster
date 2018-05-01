import React, { Component } from 'react';
import { Button } from 'react-bootstrap';
class GenerateItems extends Component {
    
    constructor(props) {
        super(props);
        this.state = {
          inputErrors: {
            num_items: '',
            job_name: '',
            job_description: '',
            num_items_valid: false,
            job_name_valid: false,
            job_description_valid: false,
            form_valid: false
          },
          item: {
            question_type: 'multi',
            num_items: '',
            job_name: '',
            job_description: '',
            job_directory: '' 
          }
        };
  
        this.handleInput = this.handleInput.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.createJobDirectory = this.createJobDirectory.bind(this);
        this.validateInput = this.validateInput.bind(this);
        this.validateForm = this.validateForm.bind(this);
      }

      handleInput(key, event) {
        var state = Object.assign({}, this.state.item);
        state[key] = event.target.value;
        this.setState(
          { item: state },
            () => { this.validateInput(key,state[key])
          }
        );
        if (!this.state.item.job_directory) {
          this.createJobDirectory();
        }
      }
  
      validateInput(key, value) {
        let inputValidationErrors = this.state.inputErrors;
        let num_items_valid = this.state.num_items_valid;
        let job_name_valid = this.state.job_name_valid;
        let job_description_valid = this.state.job_description_valid;

        switch(key) {
          case 'num_items':
            num_items_valid = value > 0;
            break;
          case 'job_name':
            job_name_valid = value.length >= 1;
            break;
          case 'job_description':
            job_description_valid = value.length >= 1;
            break;
          default:
            break;
        }

        this.setState(
          { 
            inputErrors: inputValidationErrors,
            num_items_valid: num_items_valid,
            job_name_valid: job_name_valid,
            job_description_valid: job_description_valid
          },
            this.validateForm
        );
      }

      validateForm() {
        this.setState(
          {
            form_valid: this.state.num_items_valid &&
              this.state.job_name_valid && 
                this.state.job_description_valid
          }
        );
      }

      createJobDirectory() {
        let now = new Date();
        let dd = now.getDate();
        if (dd < 10) {
          dd = '0' + dd;
        }
        let mm = now.getMonth()+1;
        if (mm < 10) { 
          mm = '0' + mm;
        }
        let yy = now.getYear() - 100;
        let random_number = Math.floor(Math.random() * 100000);
        let job_directory = mm + '-' + dd + '-' + yy + '-' + random_number;
        var state = Object.assign({},this.state.item);
        state["job_directory"] = job_directory;
        this.setState(
          { item: state }
        );
        console.log(this.state.item.job_directory);
      }

      handleSubmit(event) {
        this.createJobDirectory();
        console.log(this.state.item);
        event.preventDefault();
        this.props.generate(this.state.item);
      }
  
      render() {
            return(
                <div id="generate_items_form">
                  <form id="generate_items" onSubmit={this.handleSubmit}>
                      <label htmlFor="job_name">Job Name:
                        <input type="text"
                              onChange={ (event => this.handleInput('job_name', event))} />
                      </label><br/>
                      <label htmlFor="job_description">Job Description:
                        <input type="text"
                              onChange={ (event => this.handleInput('job_description', event))} />
                      </label><br/>
                      <label htmlFor="question_type">Question Type: 
                        <select name="question_type"  
                          onChange={ (event) => this.handleInput('question_type', event) }>
                            <option value="multi">Multiple Choice</option>
                            <option value="single">Single Select</option>
                            <option value="tf">True/False</option>
                          </select>
                      </label><br />
                      <label htmlFor="NumberOfItems">Number: 
                          <input type="number"
                                onChange={ (event) => this.handleInput('num_items', event)} />
                      </label><br /> 
                  </form>
                  <Button bsStyle="primary"
                    disabled={!this.state.form_valid} 
                    onClick={this.handleSubmit}>Create Items</Button>
                  <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            </div>                
            )
      }

}

export default GenerateItems