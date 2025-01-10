const programs = [
    { name: 'BTech CSE', semesters: [1, 2, 3, 4, 5, 6, 7, 8] },
    { name: 'BTech ECE', semesters: [1, 2, 3, 4, 5, 6, 7, 8] },
    { name: 'BTech Civil', semesters: [1, 2, 3, 4, 5, 6, 7, 8] },
    { name: 'BTech Mechanical', semesters: [1, 2, 3, 4, 5, 6, 7, 8] },
    { name: 'BTech EEE', semesters: [1, 2, 3, 4, 5, 6, 7, 8] },
    { name: 'BTech IT', semesters: [1, 2, 3, 4, 5, 6, 7, 8] },
    // Add other programs as needed
];

const subjects = {
    1: ['Mathematics I', 'Physics', 'Chemistry', 'Engineering Graphics', 'Basic Electrical Engineering', 'English'],
    2: ['Mathematics II', 'Engineering Mechanics', 'Basic Electronics', 'Programming for Problem Solving', 'Environmental Science', 'Physical Education'],
    3: ['Data Structures', 'Object-Oriented Programming', 'Digital Logic Design', 'Computer Organization', 'Signals and Systems', 'Elective I'],
    4: ['Algorithms', 'Operating Systems', 'Database Management Systems', 'Microprocessors', 'Communication Systems', 'Elective II'],
    5: ['Software Engineering', 'Computer Networks', 'Web Technologies', 'Software Testing', 'Elective III', 'Professional Ethics'],
    6: ['Compiler Design', 'Artificial Intelligence', 'Mobile Computing', 'Design and Analysis of Algorithms', 'Elective IV', 'Project Work I'],
    7: ['Cloud Computing', 'Network Security', 'Machine Learning', 'Elective V', 'Open Elective', 'Project Work II'],
    8: ['Industrial Training', 'Research Project', 'Elective VI', 'Open Elective', 'Comprehensive Viva Voce'],
    // Adjust based on the official curriculum
};


// Populate the Program dropdown
const programSelect = document.getElementById('program');
populateDropdown(programSelect, programs.map(p => p.name));

// Event listener for Program selection
programSelect.addEventListener('change', () => {
    const selectedProgram = programs.find(p => p.name === programSelect.value);
    const semesterSelect = document.getElementById('semester');

    if (selectedProgram) {
        populateDropdown(semesterSelect, selectedProgram.semesters);
    } else {
        semesterSelect.innerHTML = ''; // Clear options if no program is selected
    }
});

// Event listener for Semester selection
document.getElementById('semester').addEventListener('change', () => {
    const selectedSemester = document.getElementById('semester').value;
    const subjectSelect = document.getElementById('subject');

    if (subjects[selectedSemester]) {
        populateDropdown(subjectSelect, subjects[selectedSemester]);
    } else {
        subjectSelect.innerHTML = ''; // Clear options if no semester is selected
    }
});

// Function to populate a dropdown
function populateDropdown(selectElement, options) {
    selectElement.innerHTML = ''; // Clear existing options
    const defaultOption = document.createElement('option');
    defaultOption.text = 'Select';
    selectElement.add(defaultOption);

    options.forEach(option => {
        const optionElement = document.createElement('option');
        optionElement.text = option;
        selectElement.add(optionElement);
    });
}