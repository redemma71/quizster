import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class About extends Component {

    render() {
        return (
                <div className="scrivener-body">
                    <h2 className="header" id="scrivener-about">About Scrivener</h2>
                    <p className="main-text">
                        <span className="scrivener">Quizster</span> is a web app that creates online quizes populated
                        with fake data generated by a PHP library,  <a href="https://github.com/fzaninotto/Faker" target="_blank">
                        Faker</a>. It is merely a proof of concept for the generation of valid HTML
                        True/False, Single-Select, and Multiple-Choice quizzes, and not a
                        not a working online quiz system. <span className="scrivener">Quizster</span> contains no grading
                        logic or functionality. As such, submitted quizzes will merely be echoed back to the screen, and neither processed by
                        nor graded by the backend.
                    </p>
                    <p className="main-text">
                        <span className="scrivener">Quizster</span> was coded by Chad David Cover as 
                        a the final project for <span className="title">CS 602, Server-Side
                        Web Development,</span> (BU Met College, Spring 2018). The application utilizes <a href="https://reactjs.org/" target="_blank"> React</a>
                        and <a href="https://getbootstrap.com/" target="_blank">Bootstrap</a> on the 
                        frontend, and <a href="https://laravel.com/" target="_blank">Laravel</a>, a framework using PHP and MySQL, on the backend. 
                    </p>
                    <p className="main-text">
                        <span className="scrivener">Quizster</span> code be found on <a href="https://github.com/redemma71/quizster"
                        target="_blank">GitHub</a>.
                    </p>
                </div>
        )
    }
}

export default About;

if (document.getElementById('about')) {
    ReactDOM.render(<About />,document.getElementById('about'));
}