<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Signup For iDiscuss Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/Programs/Forum/partial/_handlesignup.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="signupemail">Email address</label>
                        <input type="email" class="form-control" id="signupemail" aria-describedby="emailHelp" name='signupemail'>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="signuppassword">Password</label>
                        <input type="password" class="form-control" id="signuppassword" name='signuppassword'>
                    </div>
                    <div class="form-group">
                        <label for="signupcpassword">Confirm Password</label>
                        <input type="password" class="form-control" id="signupcpassword" name='signupcpassword'>
                    </div>
                    <button type="submit" class="btn btn-primary">Signup</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>