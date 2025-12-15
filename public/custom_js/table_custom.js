/**
 * Global Sortable Table Module
 * Usage: add data-sortable attributes to any table
 */
/*
(function () {

    let draggedRow = null;

    document.addEventListener("dragstart", function (e) {
        const row = e.target.closest("[data-sortable-row]");
        if (!row) return;

        draggedRow = row;
        row.style.opacity = "0.4";
        e.dataTransfer.effectAllowed = "move";
    });

    document.addEventListener("dragend", function (e) {
        const row = e.target.closest("[data-sortable-row]");
        if (!row) return;

        row.style.opacity = "1";
        draggedRow = null;

 document.querySelectorAll(".sortable-over-top, .sortable-over-bottom").forEach(el => el.classList.remove("sortable-over-top", "sortable-over-bottom"));

    });

    document.addEventListener("dragover", function (e) {
        const row = e.target.closest("[data-sortable-row]");
        if (!row || !draggedRow || row === draggedRow) return;

        e.preventDefault();
        row.classList.add("sortable-over");
    });

    document.addEventListener("dragleave", function (e) {
        const row = e.target.closest("[data-sortable-row]");
        if (!row) return;

        row.classList.remove("sortable-over");
    });

    document.addEventListener("drop", function (e) {

     const row = e.target.closest("[data-sortable-row]");
    if (!row || !draggedRow || row === draggedRow) return;

    e.preventDefault();
    row.classList.remove("sortable-over");

    const rect = row.getBoundingClientRect();
    const offset = e.clientY - rect.top;

    if (offset > rect.height / 2) {
        row.parentNode.insertBefore(draggedRow, row.nextSibling);
    } else {
        row.parentNode.insertBefore(draggedRow, row);
    }

    saveOrder(row.closest("[data-sortable-table]"));

    });

    function saveOrder(table) {
        if (!table) return;

        const url   = table.dataset.sortUrl;
        const model = table.dataset.model;
        const column = table.dataset.column || "sorted_order";

        const order = [];
        table.querySelectorAll("[data-sortable-row]").forEach(row => {
            order.push(row.dataset.id);
        });

        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                model: model,
                column: column,
                order: order
            })
        });
    }

})();
*/


(function () {

    let draggedRow = null;

    document.addEventListener("dragstart", e => {
        const row = e.target.closest("[data-sortable-row]");
        if (!row) return;

        draggedRow = row;
        row.classList.add("sortable-dragging");
        e.dataTransfer.effectAllowed = "move";
    });

    document.addEventListener("dragend", () => {
        if (!draggedRow) return;

        draggedRow.classList.remove("sortable-dragging");
        draggedRow = null;

        document
            .querySelectorAll(".sortable-over-top, .sortable-over-bottom")
            .forEach(el => el.classList.remove("sortable-over-top", "sortable-over-bottom"));
    });

    document.addEventListener("dragover", e => {
        const row = e.target.closest("[data-sortable-row]");
        if (!row || !draggedRow || row === draggedRow) return;

        e.preventDefault();

        const rect = row.getBoundingClientRect();
        const offset = e.clientY - rect.top;

        row.classList.remove("sortable-over-top", "sortable-over-bottom");

        if (offset < rect.height / 2) {
            row.classList.add("sortable-over-top");
        } else {
            row.classList.add("sortable-over-bottom");
        }
    });

    document.addEventListener("dragleave", e => {
        const row = e.target.closest("[data-sortable-row]");
        if (!row) return;

        row.classList.remove("sortable-over-top", "sortable-over-bottom");
    });

    document.addEventListener("drop", e => {
        const row = e.target.closest("[data-sortable-row]");
        if (!row || !draggedRow || row === draggedRow) return;

        e.preventDefault();

        const rect = row.getBoundingClientRect();
        const offset = e.clientY - rect.top;

        row.classList.remove("sortable-over-top", "sortable-over-bottom");

        if (offset < rect.height / 2) {
            row.parentNode.insertBefore(draggedRow, row);
        } else {
            row.parentNode.insertBefore(draggedRow, row.nextSibling);
        }

        saveOrder(row.closest("[data-sortable-table]"));
    });


   function saveOrder(table) {
        if (!table) return;

        const url   = table.dataset.sortUrl;
        const model = table.dataset.model;
        const column = table.dataset.column || "sorted_order";

        const order = [];
        table.querySelectorAll("[data-sortable-row]").forEach(row => {
            order.push(row.dataset.id);
        });

        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                model: model,
                column: column,
                order: order
            })
        });
    }





})();


