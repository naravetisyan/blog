import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';
import {Redirect} from "react-router";
import AddPost from "./AddPost";
import EditPost from "./EditPost";
import DeletePost from "./DeletePost";


export default class MyPosts extends Component {
    constructor(props){
        super(props);
        this.state = {
            posts: []
        };
        this.addPost = this.addPost.bind(this);
        this.editPost = this.editPost.bind(this);
        this.deletePost = this.deletePost.bind(this);

	}
	addPost(post) {
		let posts = this.state.posts;
	    posts.push(post);
	    this.setState({posts});
	}
    editPost(post) {
    	let posts = this.state.posts;
    	posts.map((val,index) => {
    		if(val.id == post.post_id){
    			val.title = post.post_title;
    			val.text = post.text;
    			val.category_id = post.cat_name;
    			val.image = post.image;
    		}
    	})
    	this.setState({posts});
    }
    deletePost(post) {
    	let posts = this.state.posts;
        posts.map((value,index) => {
            if(value.id == post){
                posts.splice(index,1);
            }
        })
        this.setState({posts});
    }
	componentWillMount() {
		let url = '/api/me/posts';
		axios.get(url).then((response) => {
            this.setState({
				posts: response.data.my_posts
			})
		});
	}
  	render() {
  		let posts = this.state.posts;
        return (
			<div className="my_posts_all">
				<h3>My Posts</h3>
				<div className="list-group">
					<AddPost addPost={this.addPost}/>
					{	
						posts.map((value, index) => {
							let src = "../images/"+value.image;
							return (
								<div key={index}>
									<div id="mine">
										<div className="row">
											<div className="span2" >
												<a href="#" className="thumbnail bg_img">
												<img width="260" height="180" src={src}/>
												</a>
											</div>
											<div className="span6"> 
												<h3>{value.title}</h3>     
												<p className="p_1">{value.text}</p>
												<p id="p_2">
													#Category : {value.category.title}   
												</p>
											</div>
											<EditPost  
												id={value.id}
												current_name_value={value.title} 
												current_cat_value={value.category_id} 
												current_text_value={value.text} 
												editPost={this.editPost} 
											/>
										 	<DeletePost  
											 	id={value.id} 
											 	deletePost={this.deletePost} 
										 	/>
										</div>
									</div>
								</div>
							)	
						})
					}
				</div>
			</div>
    	)
    }
}
