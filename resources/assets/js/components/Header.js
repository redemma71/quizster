import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { push as Menu } from 'react-burger-menu';

class Header extends Component {

    render() {
        return (
                <Menu pageWrapId={ "page-wrap" } outerContainerId={ "outer-container" } width={ "15%" }>
                    <h3>Scrivener</h3>
                    <a id="home" className="menu-item" href="/">Home</a>
                    <a id="about" className="menu-item" href="/jobs">Jobs</a>
                    <a id="contact" className="menu-item" href="/about">About</a>
              </Menu>
        )
    }
}

export default Header;

if (document.getElementById('header')) {
    ReactDOM.render(<Header />,document.getElementById('header'));
}