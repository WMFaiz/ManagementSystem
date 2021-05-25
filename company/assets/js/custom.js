$(document).ready(function () {
  $(".msg").hide();
  $(".student_temp_list").hide();
  $(".deleteMessageConfirm").hide();

  $("[class=viewThisJob]").on("click", function () {
    var title = $(this)
      .closest("form")
      .children("p")
      .children(".title_display")
      .val();
    var desc = $(this)
      .closest("form")
      .children("p")
      .children(".des_display")
      .val();
    var acc = $(this)
      .closest("form")
      .children("p")
      .children(".acc_display")
      .val();
    var allow = $(this)
      .closest("form")
      .children("p")
      .children(".allo_display")
      .val();
    var req = $(this)
      .closest("form")
      .children("p")
      .children(".req_display")
      .val();
    var loc = $(this)
      .closest("form")
      .children("p")
      .children(".loc_display")
      .val();
    var trans = $(this)
      .closest("form")
      .children("p")
      .children(".trans_display")
      .val();

    // alert(title + "\n" +desc + "\n" +acc + "\n" +allow + "\n" +req + "\n" +loc + "\n" +trans);

    if ($(this).text() == "View") {
      $(".viewThisJob").css({
        width: "100px",
        "background-color": "rgba(145, 189, 255,1)",
        "font-size": "20px",
      });
      $(".viewThisJob").text("View");

      $(this).css({
        width: "91%",
        "background-color": "rgba(0, 102, 255,0.5)",
        "font-size": "40px",
      });
      $(this).text("Close");

      $("#title_job").val(title);
      $("#job_desc_job").val(desc);

      if (acc === "yes") {
        $("#accommodation-1").prop("checked", true);
        $("#accommodation-0").prop("checked", false);
      } else if (acc === "no") {
        $("#accommodation-1").prop("checked", false);
        $("#accommodation-0").prop("checked", true);
      }

      if (allow === "yes") {
        $("#allowance-1").prop("checked", true);
        $("#allowance-0").prop("checked", false);
      } else if (allow === "no") {
        $("#allowance-1").prop("checked", false);
        $("#allowance-0").prop("checked", true);
      }

      $("#requirement_job").val(req);
      $("#location_job").val(loc);

      if (trans === "yes") {
        $("#transport-1").prop("checked", true);
        $("#transport-0").prop("checked", false);
      } else if (trans === "no") {
        $("#transport-1").prop("checked", false);
        $("#transport-0").prop("checked", true);
      }
    } else if ($(this).text() == "Close") {
      $(this).css({
        width: "100px",
        "background-color": "rgba(145, 189, 255,1)",
        "font-size": "20px",
      });
      $(this).text("View");

      $("#title_job").val("");
      $("#job_desc_job").val("");
      $("#accommodation-1").prop("checked", false);
      $("#accommodation-0").prop("checked", false);
      $("#allowance-1").prop("checked", false);
      $("#allowance-0").prop("checked", false);
      $("#requirement_job").val("");
      $("#location_job").val("");
      $("#transport-1").prop("checked", false);
      $("#transport-0").prop("checked", false);
    }
  });

  $("[class=moreMessage]").on("click", function () {
    var msg_ele = $(this).closest("p").closest("div").children(".msg");
    var checker = msg_ele.is(":visible");
    if (!checker) {
      $(".msg").slideUp("medium");
      $(".moreMessage").css({ transform: "rotateX(180deg)" });
      msg_ele.slideDown("medium");
      $(this).css({ transform: "rotateX(0deg)" });
    } else if (checker) {
      msg_ele.slideUp("medium");
      $(this).css({ transform: "rotateX(180deg)" });
    }
  });

  $("[class=deleteMessage]").on("click", function () {
    var deleteBtn = $(this).closest("form").children('.deleteMessageConfirm');
    var checker = deleteBtn.is(":visible");
    if (!checker) {
      $(".deleteMessageConfirm").fadeOut(250);
      deleteBtn.show("slide", { direction: "left" }, 300);
    } else if (checker) {
      deleteBtn.hide("slide", { direction: "right" }, 300);
    }
  });

  $("[class=goToReply]").on("click", function () {
    $(".status_reply").empty();
    var email = $(this).closest("p").closest("div").children(".email").val();
    var id_jobpost = $(this)
      .closest("p")
      .closest("div")
      .children(".id_jobpost")
      .val();
    var sid = $(this).closest("p").closest("div").children(".sid").val();
    var appid = $(this).closest("p").closest("div").children(".appid").val();
    var msg_title = $(this)
      .closest("p")
      .closest("div")
      .children(".msg_title")
      .val();
    var msgstatus = $(this)
      .closest("p")
      .closest("div")
      .children(".msgstatus")
      .html();
    // console.log(msgstatus);
    $(".title_reply").val(msg_title);
    $(".apply_reply").val(email);
    $(".status_reply").append(msgstatus);
    $(".email_reply").val(email);
    $(".id_jobpost_reply").val(id_jobpost);
    $(".sid_reply").val(sid);
    $(".appid_reply").val(appid);
  });

  $("[class=mainmenu]").on("click", function () {
    $(".mainmenu").removeClass("active");
    $(this).addClass("active");
  });

  $("[id=mainmenu]").on("click", function () {
    var mainname = $(this).text();
    switch (mainname) {
      case "info":
        $("html, body").animate(
          {
            scrollTop: $("#info_section").offset().top,
          },
          1000
        );
        break;
      case "jobs":
        $("html, body").animate(
          {
            scrollTop: $("#job_section").offset().top,
          },
          1000
        );
        break;
      case "messages":
        $("html, body").animate(
          {
            scrollTop: $("#msg_section").offset().top,
          },
          1000
        );
        break;
      case "watchlist":
        $("html, body").animate(
          {
            scrollTop: $("#wthlist_section").offset().top,
          },
          1000
        );
        break;
      default:
        break;
    }
  });

  $("#search-btn").click(function () {
    $(".student_temp_list").empty();
    $(".result_stud").text("");
    var discipline = $("#discipline").val().toLowerCase();
    var duration = $("#duration").val().toLowerCase();
    var start = $("#start").val().toLowerCase();
    var counter = 0;
    $(".studentCard").each(function (i) {
      var getStudentCard =
        '<div class="col-sm-6 col-lg-4 studentCard">' +
        $(this).html() +
        "</div>";
      var stud_discipline = $(this)
        .children("div")
        .children("div")
        .children("#stud_discipline")
        .text()
        .toLowerCase();
      var stud_duration = $(this)
        .children("div")
        .children("div")
        .children("p")
        .children(".stud_duration")
        .text()
        .toLowerCase();
      var stud_start = GetMonthName(
        parseInt(
          $(this)
            .children("div")
            .children("div")
            .children("p")
            .children(".interndate_form")
            .text()
            .split("/")[0]
        )
      ).toLowerCase();
      if (
        discipline == stud_discipline &&
        duration == stud_duration &&
        start == stud_start
      ) {
        $(".result_stud").text("Your result");
        $(".student_temp_list").append(getStudentCard);
        counter++;
      } else if (
        discipline == "any" &&
        duration == stud_duration &&
        start == stud_start
      ) {
        $(".result_stud").text("Your result");
        $(".student_temp_list").append(getStudentCard);
        counter++;
      } else if (
        discipline == stud_discipline &&
        duration == "any" &&
        start == stud_start
      ) {
        $(".result_stud").text("Your result");
        $(".student_temp_list").append(getStudentCard);
        counter++;
      } else if (
        discipline == stud_discipline &&
        duration == stud_duration &&
        start == "any"
      ) {
        $(".result_stud").text("Your result");
        $(".student_temp_list").append(getStudentCard);
        counter++;
      } else if (
        discipline == "any" &&
        duration == "any" &&
        start == stud_start
      ) {
        $(".result_stud").text("Your result");
        $(".student_temp_list").append(getStudentCard);
        counter++;
      } else if (
        discipline == stud_discipline &&
        duration == "any" &&
        start == "any"
      ) {
        $(".result_stud").text("Your result");
        $(".student_temp_list").append(getStudentCard);
        counter++;
      } else if (
        discipline == "any" &&
        duration == stud_duration &&
        start == "any"
      ) {
        $(".result_stud").text("Your result");
        $(".student_temp_list").append(getStudentCard);
        counter++;
      } else if (discipline == "any" && duration == "any" && start == "any") {
        $(".result_stud").text("Your result");
        $(".student_temp_list").append(getStudentCard);
        counter++;
      }
    });
    if (counter > 0) {
      $(".result_stud").text("Found (" + counter + ") result");
    } else if (counter <= 0) {
      $(".result_stud").text("No result found");
    }
    $(".student_temp_list").slideDown("medium");
  });

  $("#clear-btn").click(function () {
    $(".student_temp_list").slideUp("medium", function () {
      $(".student_temp_list").empty();
      $(".result_stud").text("");
    });
  });
});

function GetMonthName(monthNumber) {
  switch (monthNumber) {
    case 1:
      return "January";
    case 2:
      return "February";
    case 3:
      return "March";
    case 4:
      return "April";
    case 5:
      return "May";
    case 6:
      return "June";
    case 7:
      return "July";
    case 8:
      return "August";
    case 9:
      return "September";
    case 10:
      return "October";
    case 11:
      return "November";
    case 12:
      return "December";
    default:
      break;
  }
}
