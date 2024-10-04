<?php
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('job-pinned-finished', function ($user) {
    // Add your authentication logic here
    return true; // or some condition to check if the user is authorized
});