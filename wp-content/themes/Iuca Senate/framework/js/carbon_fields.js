window.addEventListener("load", () => {
  console.log('load');
  if (
    document.querySelector("   .inside > fieldset > .cf-container > .cf-container__fields > .cf-field > .cf-field__body > .cf-complex__actions > .cf-complex__toggler")
  ) {
    console.log("click");
    document
      .querySelector(
        "  .inside > fieldset > .cf-container > .cf-container__fields > .cf-field > .cf-field__body > .cf-complex__actions > .cf-complex__toggler"
      )
      .click();

    setInterval(function () {
      console.log('set');
      if (
        document.querySelectorAll(
          '.cf-container-post-meta > .cf-container__fields > .cf-complex > .cf-field__body > .cf-complex__groups > .cf-complex__group > input[name*="[value]"'
        )
      ) {
        let elems = document.querySelectorAll(
          '.cf-container-post-meta > .cf-container__fields > .cf-complex > .cf-field__body > .cf-complex__groups > .cf-complex__group > input[name*="[value]"'
        );

        for (let i = 0; i < elems.length; i++) {
          let parent = elems[i].parentElement;

          if (
            !parent.querySelector(".cf-complex__group-image") &&
            parent.getAttribute("data-thumb") != "true"
          ) {
            parent.setAttribute("data-thumb", true);

            let wrap = document.createElement("span");

            wrap.classList.add("cf-complex__group-image");
            wrap.style.display = "flex";
            wrap.style.border = "1px solid #b4b4b4";
            wrap.style.padding = "6px";
            wrap.style.borderRadius = "3px";

            let image = document.createElement("img");

            image.src =
              "/wp-content/themes/mt_framework/fields/preview/" +
              elems[i].value +
              ".png";

            var client = new XMLHttpRequest();
            client.onreadystatechange = handler;
            client.open("GET", image.src); //HEAD или GET погоды не меняют
            client.send();

            function handler() {
              if (this.status == "200") {
                image.style.width = "300px";
                image.style.height = "auto";

                wrap.appendChild(image);

                let headElem = parent.querySelector(".cf-complex__group-head");

                headElem.insertBefore(
                  wrap,
                  headElem.querySelector(".cf-complex__group-title")
                );
              }
            }
          }
        }
      }
    }, 500);
  }
});
