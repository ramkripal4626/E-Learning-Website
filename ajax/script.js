$(document).ready(function () {
  // Fetch courses
  $.ajax({
      url: 'data.php',
      type: 'GET',
      data: { type: 'courses' },
      dataType: 'json',
      success: function (data) {
          $('#course-dropdown').empty().append('<option value="">Select Course</option>');
          $.each(data, function (index, course) {
              $('#course-dropdown').append('<option value="' + course.course_id + '">' + course.course_name + '</option>');
          });
      }
  });

  // Fetch branches based on selected course
  $('#course-dropdown').change(function () {
      var courseId = $(this).val();
      if (courseId) {
          $.ajax({
              url: 'data.php',
              type: 'GET',
              data: { type: 'branches', course_id: courseId },
              dataType: 'json',
              success: function (data) {
                  $('#branch-dropdown').empty().append('<option value="">Select Branch</option>');
                  $.each(data, function (index, branch) {
                      $('#branch-dropdown').append('<option value="' + branch.branch_id + '">' + branch.branch_name + '</option>');
                  });
              }
          });
      } else {
          $('#branch-dropdown').empty().append('<option value="">Select Branch</option>');
      }
      $('#semester-dropdown').empty().append('<option value="">Select Semester</option>');
      $('#subject-dropdown').empty().append('<option value="">Select Subject</option>');
  });

  // Fetch semesters based on selected branch
  $('#branch-dropdown').change(function () {
      var branchId = $(this).val();
      if (branchId) {
          $.ajax({
              url: 'data.php',
              type: 'GET',
              data: { type: 'semesters', branch_id: branchId },
              dataType: 'json',
              success: function (data) {
                  $('#semester-dropdown').empty().append('<option value="">Select Semester</option>');
                  $.each(data, function (index, semester) {
                      $('#semester-dropdown').append('<option value="' + semester.semester_id + '">' + semester.semester_name + '</option>');
                  });
              }
          });
      } else {
          $('#semester-dropdown').empty().append('<option value="">Select Semester</option>');
      }
      $('#subject-dropdown').empty().append('<option value="">Select Subject</option>');
  });

  // Fetch subjects based on selected semester
  $('#branch-dropdown, #semester-dropdown').change(function () {
      var branchId = $('#branch-dropdown').val();
      var semesterId = $('#semester-dropdown').val();

      if (branchId && semesterId) {
          $.ajax({
              url: 'data.php',
              type: 'GET',
              data: {
                  type: 'subjects',
                  branch_id: branchId,
                  semester_id: semesterId
              },
              dataType: 'json',
              success: function (data) {
                  $('#subject-dropdown').empty().append('<option value="">Select Subject</option>');
                  $.each(data, function (index, subject) {
                      $('#subject-dropdown').append('<option value="' + subject.subject_id + '">' + subject.subject_name + '</option>');
                  });
              }
          });
      } else {
          $('#subject-dropdown').empty().append('<option value="">Select Subject</option>');
      }
  });

});