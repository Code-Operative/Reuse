if(document.getElementsByClassName("product-additional-info")[0]){
    const additionalInfo = document.getElementsByClassName("product-additional-info")[0];

    if(additionalInfo.getElementsByClassName("panel-product-actions")[0]){
        const productActions = additionalInfo.getElementsByClassName("panel-product-actions")[0];

        const reportItem = document.createElement("a");
        reportItem.innerHTML = "Report this item";
        reportItem.id = "report-item";

        const itemURL = window.location.href;
        const itemName = document.title;

        // the code %0D%0A is a line break

        const emailContent = `Hello Reuse Admin,
            %0D%0A
            %0D%0AI'd like to report that the item "${itemName}" on Reuse Home is not fit for purpose on the site. The item's link is ${itemURL}
            %0D%0A
            %0D%0AThank you,
            %0D%0AReuse Customer
            %0D%0A%0D%0A`;

        reportItem.href = `mailto:info@reuse-home.org.uk?subject=Reporting Item On Reuse Home &body=${emailContent}`;

        productActions.append(reportItem);
    }
}