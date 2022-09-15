/*Core 1.0*/

$(document).ready(function () {
    $("#table-teams>tbody tr").on("click", function () {
        var tableData = $(this)
            .children("td")
            .map(function () {
                return $(this).text();
            })
            .get();

        var id = tableData[0];
        var time = tableData[1];
        var jogador = tableData[2];

        $("#id").val(id);
        $("#time").val(time);
        $("#jogador").val(jogador);

        $("#idedit").val(id);
        $("#timeedit").val(time);
        $("#jogadoredit").val(jogador);
    });

    $("#table-matches>tbody tr").on("click", function () {
        var tableData = $(this)
            .children("td")
            .map(function () {
                return $(this).text();
            })
            .get();

        var id = tableData[0];
        var nameSeason = tableData[1];
        var idTeama = tableData[3];
        var GolTeama = tableData[4];
        var idTeamb = tableData[5];
        var GolTeamb = tableData[6];
        var DataSeason = tableData[2];

        $("#idSeason").val(id);
        $("#nameSeason").val(nameSeason);
        $("#idTeama").val(idTeama);
        $("#GolTeama").val(GolTeama);
        $("#idTeamb").val(idTeamb);
        $("#GolTeamb").val(GolTeamb);
        $("#DataSeason").val(DataSeason);
    });

    $("#frmSeasonAdd").submit(function (e) {
        var golteama = $("#golteam_a").val();
        var golteamb = $("#golteam_b").val();
        var dataSeason = $("#dataSeason").val();
        var timea = $("#SelectTeamA").val();
        var timeb = $("#SelectTeamB").val();
        var tempporada = $("#SelectSeason").val();

        var valid = false;

        if (golteama === "") {
            $("#golteam_a").addClass("is-invalid");
            $("#qtdetimaa").text("Quantidade é obrigatório.");
            valid = true;
        } else if (parseInt(golteama) < 0) {
            $("#golteam_a").addClass("is-invalid");
            $("#qtdetimaa").text("Valor inválido");
            valid = true;
        } else {
            $("#golteam_a").removeClass("is-invalid");
        }

        if (golteamb === "") {
            $("#golteam_b").addClass("is-invalid");
            valid = true;
        } else if (parseInt(golteamb) < 0) {
            $("#golteam_b").addClass("is-invalid");
            $("#qtdetimab").text("Valor inválido");
            valid = true;
        } else {
            $("#golteam_b").removeClass("is-invalid");
        }

        if (dataSeason === "") {
            $("#dataSeason").addClass("is-invalid");
            valid = true;
        } else {
            $("#dataSeason").removeClass("is-invalid");
        }

        if (timea === "0") {
            $("#SelectTeamA").addClass("is-invalid");
            valid = true;
        } else {
            $("#SelectTeamA").removeClass("is-invalid");
        }

        if (timeb === "0") {
            $("#SelectTeamB").addClass("is-invalid");
            $("#msgerrtimeb").text("TIme B é obrigatório.");
            valid = true;
        } else if (timeb === timea) {
            $("#SelectTeamB").addClass("is-invalid");
            $("#msgerrtimeb").text("Time B não pode ser igual ao time A");
            valid = true;
        } else {
            $("#SelectTeamB").removeClass("is-invalid");
        }

        if (tempporada === "0") {
            $("#SelectSeason").addClass("is-invalid");
            valid = true;
        } else {
            $("#SelectSeason").removeClass("is-invalid");
        }

        if (valid) {
            e.preventDefault();
        }
    });
});
