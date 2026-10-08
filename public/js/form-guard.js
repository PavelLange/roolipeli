
document.addEventListener("submit", function (event) {
    const form = event.target;

    if (!(form instanceof HTMLFormElement)) {
        return;
    }

    const button = form.querySelector(
        'button[type="submit"], input[type="submit"], button:not([type])'
    );

    if (!button || button.disabled) {
        return;
    }

    setTimeout(function () {
        // By now every other submit handler has run. If one of them
        // cancelled the submit - a validation error, or answering No to
        // a confirm() - the form was never sent and the page is not
        // going anywhere, so the button must stay usable.
        if (event.defaultPrevented) {
            return;
        }

        button.disabled = true;

        if (button.tagName === "BUTTON") {
            button.dataset.originalLabel = button.textContent;
            button.textContent = "Working...";
        }
    }, 0);
});

window.addEventListener("pageshow", function (event) {
    if (!event.persisted) {
        return;
    }

    document.querySelectorAll("button[disabled]").forEach(function (button) {
        if (button.dataset.originalLabel) {
            button.textContent = button.dataset.originalLabel;
            button.disabled = false;
        }
    });
});
