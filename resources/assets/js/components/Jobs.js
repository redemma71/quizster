import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Grid, Row, Col, Glyphicon, Form, FormGroup, FormControl, InputGroup, Button } from 'react-bootstrap';

class Jobs extends Component {

    constructor() {
        super();
        this.state = {
            jobs: [],
            searchTerm: ''
        }

        this.searchJobs = this.searchJobs.bind(this);
        this.formatTime = this.formatTime.bind(this);
        this.handleInput = this.handleInput.bind(this);
        this.getAllJobs = this.getAllJobs.bind(this);
    
    }

    componentDidMount() {
        fetch('/api/jobs')
            .then(response => {
                return response.json();
            })
            .then(jobs => {
                this.setState({ jobs });
            });
        }
     
    formatTime (date) {
        let hours = date.getHours();
        // handle 0 - 9 minutes
        let minutes = date.getMinutes();
        minutes = minutes > 10 ? minutes : "0" + minutes;
        
        return hours + ":" + minutes;
    }

    formatDate (date) {
        let month = date.getMonth() + 1;
        let day = date.getDate();
        let year = date.getYear() - 100;
        return month + "/" + day + "/" + year;
    }

    handleInput(key, event) {
        var state = Object.assign({}, this.state.searchTerm);
        state = event.target.value.trim();
        this.setState(
            { searchTerm: state}
        );
        if (state.length === 0) {
            console.log(this.state.searchTerm.length);
            this.getAllJobs();
        } else {
            this.searchJobs(event);
        }
    }


    getAllJobs() {
        fetch('/api/jobs')
        .then(response => {
            return response.json();
        })
        .then(jobs => {
            this.setState({ jobs });
        });
    }

    showJobs() {
        return this.state.jobs.map( (job) => {

          
            let date = new Date(job.updated_at);
            date.setTime( date.getTime() + date.getTimezoneOffset()*60*1000 );
            let datestamp = this.formatDate(date);
            let timestamp = this.formatTime(date);
            let firstQuestion = '';
            if (job.jobType === 'multi') {
                firstQuestion = 'multi-1.html';
            } else if (job.jobType === 'single') {
                firstQuestion = 'single-1.html';
            } else {
                firstQuestion = 'tf-1.html';
            }

            return (
                <Row className="show-grid" key={job.id}>
                  <Col xs={1} md={1} lg={1}>{ datestamp }</Col>
                  <Col xs={1} md={1} lg={1}>{ timestamp }</Col>
                  <Col xs={2} md={2} lg={2}><a href={`http://127.0.0.1:8000/storage/cs602/${job.jobUrl}/${firstQuestion}`} target="_blank">Quiz</a></Col>
                  <Col xs={2} md={2} lg={2}>{ job.jobName }</Col>
                  <Col xs={4} md={4} lg={4}>{ job.jobDescription }</Col>
                </Row>
            );
        })
      }
       
      searchJobs(event) {
        event.preventDefault();
        let search_form = new FormData();
        search_form.append('search_string',this.state.searchTerm);

        fetch('api/jobs/search',
        {
            method: 'POST',
            body: search_form
        })
        .then( (response) => {
            if (response.status == 200) {
                return response.json();
            }
        })
        .then( (response) => {
            // response.forEach( (job) => {
                this.setState(
                    { jobs: response }
                )
            // })
        })
        .catch( (error) => console.log(error) )

      }


      render() {
        return (
            <div className="scrivener-body">
                <h2 className="header" id="scrivener-jobs">Quizster Jobs</h2>
                <Grid className="show-grid" id="jobs-table">
                    <Row className="search-form" id="search-form-input">
                        <Col sm={4} smOffset={6} md={4} mdOffset={6} lg={4} lgOffset={6} >
                            <div className="input-group search-bar">
                                <Form>
                                    <FormGroup controlId="searchJobs">
                                        <InputGroup>
                                            <FormControl
                                                type="text"
                                                onChange={ ( (event) => this.handleInput('search_string',event)) }
                                                name="search_string"
                                                className="form-control"
                                                placeholder="Search Jobs"/>
                                                <InputGroup.Addon>
                                                    <Glyphicon glyph="search" />
                                                </InputGroup.Addon>
                                        </InputGroup>
                                    </FormGroup>
                                    <FormGroup>
                                        <FormControl type="hidden"
                                            name="_token"
                                            id="csrf-token"
                                            value="{{ Session::token() }}"
                                        />
                                    </FormGroup>
                                    <Button type="submit" id="search-button"/>
                                    </Form>                                
                            </div>
                        </Col>
                    </Row>
                    <Row className="show-grid" id="jobs-table-header">
                        <Col sm={1} md={1} lg={1} className="jobs-table-header-td">Date</Col>
                        <Col sm={1} md={1} lg={1} className="jobs-table-header-td">Time</Col>
                        <Col sm={2} md={2} lg={2} className="jobs-table-header-td">Link</Col>
                        <Col sm={2} md={2} lg={2} className="jobs-table-header-td">Job Title</Col>
                        <Col sm={4} md={4} lg={4} className="jobs-table-header-td">Job Description</Col>
                    </Row>
                    { this.showJobs() }
                    <Row>
                        <div id="footer" />
                    </Row>     
                </Grid>
            </div>
            
        );
      }
}

export default Jobs;

if (document.getElementById('jobs')) {
    ReactDOM.render(<Jobs />, document.getElementById('jobs'));
}