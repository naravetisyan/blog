import React, { Component } from 'react';
import PropTypes from 'prop-types';
 
export default class DeletePostModal extends Component {
    render() {
        return (                  
            <div id={this.props.body_id+'delete'} className="modal fade" role="dialog">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h4 className="modal-title">Delete Post</h4>
                        </div>
                        <div className="modal-body">
                            <p>Remove a Post <span id='delete-post'></span> ?</p>
                            <input type="submit" id='delete-click' onClick={this.props.deletePost} value="Yes" data-dismiss="modal" /> 
                            <button type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>        
        );
    }
}