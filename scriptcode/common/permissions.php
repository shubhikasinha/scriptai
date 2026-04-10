<?php
function canEditPosts() {
  return in_array($_SESSION['role'], ['admin', 'editor']);
}

function canManageUsers() {
  return $_SESSION['role'] === 'admin';
}

function canComment() {
  return in_array($_SESSION['role'], ['admin', 'editor', 'user', 'viewer']);
}
