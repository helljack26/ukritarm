export const addSpaceToNumber = (number) => {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    return parts.join(".");
}

export const removeSpaceFromNumber = (number) => {
    var parts = number.toString().split(" ");
    return parts.join("");
}