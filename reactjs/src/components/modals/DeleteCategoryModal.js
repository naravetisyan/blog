import React, { Component } from 'react';
import PropTypes from 'prop-types';
 
export default class DeleteCategoryModal extends Component {
    render() {
        return (                  
            <div id={this.props.body_id+'delete'} className="modal fade" role="dialog">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h4 className="modal-title">Delete Category</h4>
                        </div>
                        <div className="modal-body">
                            <p>Remove a category <span id='delete_category'></span> ?</p>
                            <input type="submit" id='delete_click' onClick={this.props.deleteCategory} value="Yes" data-dismiss="modal" /> 
                            <button type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>        
        );
    }
}
