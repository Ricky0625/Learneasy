<!DOCTYPE html>
<html>
    <head>
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    </head>
<style>
/* The container */
.progress-container {
  display: block;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  transition: 0.3s;
}

/* Hide the browser's default checkbox */
.progress-container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.progress-checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  border-radius: 50%;
  background-color: #B4BFCC;
  display: flex;
  align-items: center;
  vertical-align: middle;
  transition: 0.3s;
}
.progress-checkmark i {
    margin-left: 3.5px;
    color: #fff;
}

/* On mouse-over, add a grey background color */
.progress-container:hover input ~ .progress-checkmark{
  background-color: #FA8474;
}

/* When the checkbox is checked, add a orange background */
.progress-container input:checked ~ .progress-checkmark {
  background-color: #FF6B58;
}

.progress-container input:checked ~ .progress-checkmark i{
  display: block;
}

/* Create the checkmark/indicator (hidden when not checked) */
.progress-checkmark i{
  position: absolute;
  display: none;
}
</style>
<body>
<label class="progress-container">
  <input type="checkbox">
  <span class="progress-checkmark"><i class="fas fa-check"></i></span>
</label>
</body>
</html>