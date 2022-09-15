/*Core DashBoard 1.0*/

$(document).ready(function () {
    $("#btnDashPartidaRealizada").click(function (e) {
        setTableData();
    });

    $("#btnDashPartidaDay").click(function (e) {
        setTableDataDay();
        setTableDataDayResumo();
    });

    $("#btnDashResumodashSeasons").click(function (e) {
        setTableDateDashSeason();
    });

    $("#dtmatches").datepicker({
        showOn: "button",
        buttonImage: "../img/icons8-calendário-24.png",
        buttonImageOnly: true,
        dateFormat: "dd/mm/yy",
        closeText: "Fechar",
        prevText: "&#x3C;Anterior",
        nextText: "Próximo&#x3E;",
        currentText: "Hoje",
        monthNames: [
            "Janeiro",
            "Fevereiro",
            "Março",
            "Abril",
            "Maio",
            "Junho",
            "Julho",
            "Agosto",
            "Setembro",
            "Outubro",
            "Novembro",
            "Dezembro",
        ],
        monthNamesShort: [
            "Jan",
            "Fev",
            "Mar",
            "Abr",
            "Mai",
            "Jun",
            "Jul",
            "Ago",
            "Set",
            "Out",
            "Nov",
            "Dez",
        ],
        dayNames: [
            "Domingo",
            "Segunda-feira",
            "Terça-feira",
            "Quarta-feira",
            "Quinta-feira",
            "Sexta-feira",
            "Sábado",
        ],
        dayNamesShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
        dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
        weekHeader: "Sm",
        firstDay: 1,
    });

    $("#dtmatchesday").datepicker({
        showOn: "button",
        buttonImage: "../img/icons8-calendário-24.png",
        buttonImageOnly: true,
        dateFormat: "dd/mm/yy",
        closeText: "Fechar",
        prevText: "&#x3C;Anterior",
        nextText: "Próximo&#x3E;",
        currentText: "Hoje",
        monthNames: [
            "Janeiro",
            "Fevereiro",
            "Março",
            "Abril",
            "Maio",
            "Junho",
            "Julho",
            "Agosto",
            "Setembro",
            "Outubro",
            "Novembro",
            "Dezembro",
        ],
        monthNamesShort: [
            "Jan",
            "Fev",
            "Mar",
            "Abr",
            "Mai",
            "Jun",
            "Jul",
            "Ago",
            "Set",
            "Out",
            "Nov",
            "Dez",
        ],
        dayNames: [
            "Domingo",
            "Segunda-feira",
            "Terça-feira",
            "Quarta-feira",
            "Quinta-feira",
            "Sexta-feira",
            "Sábado",
        ],
        dayNamesShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
        dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
        weekHeader: "Sm",
        firstDay: 1,
    });

    function setTableData() {
        var seasonname = $("#idseasons option:selected").text();
        var idseasons = $("#idseasons").val();
        var dtmatches = $("#dtmatches").val();
        $("#msgErro").text("");

        var table = $("#table-matches").DataTable({
            processing: true,
            ServerSide: true,
            order: [[0, "desc"]],
            bDestroy: true,
            responsive: true,
            paging: true,
            searching: false,
            language: {
                url: "/fifamobile/public/js/datatable/pt-BR.json",
            },
            ajax: {
                url: "/fifamobile/public/matches/showpartidas",
                dataSrc: "",
                type: "POST",
                data: function (d) {
                    d._token = $('meta[name="csrf-token"]').attr("content");
                    d.idseason = idseasons;
                    d.seasonname = seasonname;
                    d.dtmatche = dtmatches;
                },
            },
            columns: [
                { data: "id" },
                { data: "name_season" },
                { data: "data_partida" },
                { data: null },
                { data: "resultado_a", className: "text-center" },
                { data: null },
                { data: "resultado_b", className: "text-center" },
                { data: "name_user" },
                { data: null, className: "text-center" },
            ],
            aoColumnDefs: [
                {
                    aTargets: [8],
                    mData: "id",
                    mRender: function (data, type, full) {
                        return (
                            "<a  data-bs-toggle='modal' data-bs-target='#ModalDelete' href='" +
                            data.id +
                            "'><i class='fa fa-trash fa-lg' aria-hidden='true'></i></a>"
                        );
                    },
                },
                {
                    aTargets: [3],
                    mData: ["resultado_a", "resultado_b", "name_teama"],
                    mRender: function (data, type, full) {
                        var retstring = "";

                        if (data.resultado_a > data.resultado_b) {
                            retstring =
                                "<img width='16' height='16' src='../img/trophy.png' alt='lider'>" +
                                " " +
                                data.name_teama;
                        } else {
                            retstring = data.name_teama;
                        }

                        return retstring;
                    },
                },
                {
                    aTargets: [5],
                    mData: ["resultado_a", "resultado_b", "name_teamb"],
                    mRender: function (data, type, full) {
                        var retstring = "";
                        if (data.resultado_a < data.resultado_b) {
                            retstring =
                                "<img width='16' height='16' src='../img/trophy.png' alt='lider'>" +
                                " " +
                                data.name_teamb;
                        } else {
                            retstring = data.name_teamb;
                        }

                        return retstring;
                    },
                },
            ],
        });

        $("#btn-delete-dash").click(function (e) {
            var idSeason = $("#idSeason").val();
            var _tokenvar = $('meta[name="csrf-token"]').attr("content");
            var htmlerr =
                "<div class='alert alert-danger alert-dismissible fade show mt-2' role='alert'><p>#msgerrs<p/><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

            $.post(
                "/fifamobile/public/matches/view/delmatches",
                { _token: _tokenvar, idSeason: idSeason },
                function (result) {
                    if (result.iderr === 1) {
                        $("#msgErro").html(
                            htmlerr.replace("#msgerrs", result.msgErr)
                        );
                    } else {
                        setTableData();
                        $("#msgErro").html("");
                    }
                }
            );
        });

        var tableData;

        $("#table-matches>tbody").on("click", "tr", function () {
            tableData = $(this)
                .children("td")
                .map(function () {
                    return $(this).text();
                })
                .get();

            $(this).removeClass("deleterow");
            $(this).addClass("deleterow");

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
    }

    function setTableDataDayResumo() {
        var dtmatchesday = $("#dtmatchesday").val();

        if (dtmatchesday === "") {
            $("#dtmatchesday").addClass("is-invalid");
            return;
        } else {
            $("#dtmatchesday").removeClass("is-invalid");
        }

        var table = $("#table-matches-day-teams").DataTable({
            processing: true,
            ServerSide: true,
            bDestroy: true,
            responsive: true,
            paging: false,
            searching: false,
            ordering: false,
            info: false,
            language: {
                url: "/fifamobile/public/js/datatable/pt-BR.json",
            },
            ajax: {
                url: "/fifamobile/public/matches/resumodashday",
                dataSrc: "",
                type: "POST",
                data: function (d) {
                    d._token = $('meta[name="csrf-token"]').attr("content");
                    d.dtmatche = dtmatchesday;
                },
            },
            columns: [
                { data: "name_season" },
                { data: "name_teams" },
                { data: "qtd_winner", className: "text-center" },
                { data: "qtd_lost", className: "text-center" },
                { data: "qtd_tied", className: "text-center" },
                { data: "qtd_gols_p", className: "text-center" },
                { data: "qtd_gols_n", className: "text-center" },
                { data: "qtd_gols_saldo", className: "text-center" },
            ],
        });
    }

    function setTableDataDay() {
        var seasonname = 0;
        var idseasons = "";
        var dtmatchesday = $("#dtmatchesday").val();

        if (dtmatchesday === "") {
            $("#dtmatchesday").addClass("is-invalid");
            return;
        } else {
            $("#dtmatchesday").removeClass("is-invalid");
        }

        var table = $("#table-matches-day").DataTable({
            processing: true,
            ServerSide: true,
            order: [[0, "desc"]],
            bDestroy: true,
            responsive: true,
            paging: true,
            searching: false,
            language: {
                url: "/fifamobile/public/js/datatable/pt-BR.json",
            },
            ajax: {
                url: "/fifamobile/public/matches/showpartidas",
                dataSrc: "",
                type: "POST",
                data: function (d) {
                    d._token = $('meta[name="csrf-token"]').attr("content");
                    d.idseason = idseasons;
                    d.seasonname = seasonname;
                    d.dtmatche = dtmatchesday;
                },
            },
            columns: [
                { data: "id" },
                { data: "name_season" },
                { data: "data_partida" },
                { data: null },
                { data: "resultado_a", className: "text-center" },
                { data: null },
                { data: "resultado_b", className: "text-center" },
                { data: "name_user" },
            ],
            aoColumnDefs: [
                {
                    aTargets: [3],
                    mData: ["resultado_a", "resultado_b", "name_teama"],
                    mRender: function (data, type, full) {
                        var retstring = "";

                        if (data.resultado_a > data.resultado_b) {
                            retstring =
                                "<img width='16' height='16' src='../img/trophy.png' alt='lider'>" +
                                " " +
                                data.name_teama;
                        } else {
                            retstring = data.name_teama;
                        }

                        return retstring;
                    },
                },
                {
                    aTargets: [5],
                    mData: ["resultado_a", "resultado_b", "name_teamb"],
                    mRender: function (data, type, full) {
                        var retstring = "";

                        if (data.resultado_a < data.resultado_b) {
                            retstring =
                                "<img width='16' height='16' src='../img/trophy.png' alt='lider'>" +
                                " " +
                                data.name_teamb;
                        } else {
                            retstring = data.name_teamb;
                        }

                        return retstring;
                    },
                },
            ],
        });
    }

    function setTableDateDashSeason() {
        var idseasons = $("#idseasonsdash").val();

        var table = $("#table-matches-seasons").DataTable({
            processing: true,
            ServerSide: true,
            bDestroy: true,
            responsive: true,
            paging: true,
            searching: false,
            paging: false,
            searching: false,
            ordering: false,
            info: false,
            language: {
                url: "/fifamobile/public/js/datatable/pt-BR.json",
            },
            ajax: {
                url: "/fifamobile/public/matches/resumodashseasons",
                dataSrc: "",
                type: "POST",
                data: function (d) {
                    d._token = $('meta[name="csrf-token"]').attr("content");
                    d.idseasons = idseasons;
                },
            },
            columns: [
                { data: "name_season" },
                { data: "name_teams" },
                { data: "qtd_winner", className: "text-center" },
                { data: "qtd_lost", className: "text-center" },
                { data: "qtd_tied", className: "text-center" },
                { data: "qtd_gols_p", className: "text-center" },
                { data: "qtd_gols_n", className: "text-center" },
                { data: "qtd_gols_saldo", className: "text-center" },
            ],
        });
    }
});
