import React from 'react';

export default class RegisterForm extends React.Component{
    constructor(props) {
        super(props);
        this.state = {
            firstNameValue: '',
            lastNameValue: '',
            emailValue: '',
            passwordValue: '',
            firstNameError: '',
            lastNameError: '',
            emailError: '',
            passwordError: '',
            successMessage: '',
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleChange(e) {
        if(e.target.name === 'firstname') {
            this.setState({
                firstNameValue: e.target.value
            });
        }

        if(e.target.name === 'lastname') {
            this.setState({
                lastNameValue: e.target.value
            });
        }

        if(e.target.name === 'email') {
            this.setState({
                emailValue: e.target.value,
            });
        }

        if(e.target.name === 'password') {
            this.setState({
                passwordValue: e.target.value,
            });
        }
    }

    handleSubmit(e) {
        e.preventDefault();

        $.ajax({
            url: 'http://127.0.0.1:8000/api/user',
            type: 'POST',
            data: {
                fullname: this.state.fullnameValue,
                email: this.state.emailValue,
                password: this.state.passwordValue
            },
            dataType: 'json',
            success: function(response) {
                this.setState({
                    fullnameError: response.fullnameError ? response.fullnameError : null,
                    emailError: response.emailError ? response.emailError : null,
                    passwordError: response.passwordError ? response.passwordError : null,
                    successMessage: response.success_message ? response.success_message : null,
                });
            }.bind(this),
            error: function(xhr) {
                console.log(`An error occured: ${xhr.status} ${xhr.statusText}`);
            }
        });
    }

    render() {
        return (
            <form className="form-signin" onSubmit={this.handleSubmit}>
                <h1 className="h3 mb-3 font-weight-normal">Register</h1>
                <label htmlFor="fullname" className="sr-only">First Name</label>
                <input type="text" name='firstname' className="form-control" value={this.state.fullnameValue} onChange={this.handleChange} id="firstname" placeholder="First Name" />
                <small>{this.state.fullnameError}</small>

                <label htmlFor="fullname" className="sr-only">Last Name</label>
                <input type="text" name='lastname' className="form-control" value={this.state.fullnameValue} onChange={this.handleChange} id="lastname" placeholder="Last Name" />
                <small>{this.state.fullnameError}</small>

                <label htmlFor="email" className="sr-only">Email</label>
                <input type="email" name='email' className="form-control" value={this.state.emailValue} onChange={this.handleChange} id="email" placeholder="Email address" />
                <small>{this.state.emailError}</small>

                <label htmlFor="password" className="sr-only">Password</label>
                <input type="password" name='password' className="form-control" value={this.state.passwordValue} onChange={this.handleChange} id="password" placeholder="Password" />
                <small>{this.state.passwordError}</small>

                <button className="btn btn-lg btn-primary btn-block" type="submit">Register</button>
                <span className='text-success'>{this.state.successMessage}</span>
            </form>
        );
    }
}

