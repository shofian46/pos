<?php
function group1()
{
  return [
    1 => 'Instructor'
  ];
}
function group2()
{
  return [
    2 => 'Student'
  ];
}
function group3()
{
  return [
    3 => 'Administrator',
    4 => 'Admin',
    5 => 'PIC'
  ];
}
function role_available()
{
  //  1: // Instructors
  //  2: // Students
  return [
    1 => 'Instructor',
    2 => 'Student'
  ];
}

// in_array
function canAddModul($role)
{
  if (in_array($role, group1())) {
    return true;
  }
}
