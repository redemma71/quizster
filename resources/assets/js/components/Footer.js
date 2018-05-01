import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Footer extends Component {

    render() {
        return (
               <div id="footer">
                    <span className="copy-left">&copy;</span> 2018 - Chad David Cover
               </div>
        )
    }
}

export default Footer;

if (document.getElementById('footer')) {
    ReactDOM.render(<Footer />,document.getElementById('footer'));
}