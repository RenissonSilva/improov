describe("tela inicial", () => {
    beforeEach(() => {
        cy.visit("https://improov.herokuapp.com/");
    });

    it("verifica se o dominio existe", () => {
        const baseUrl = "https://improov.herokuapp.com/";
        cy.url().should("eq", baseUrl);
    });

    it("verifica se esta na pagina inicial", () => {
        cy.contains(".title", "Improov").should("be.visible");
        cy.contains(
            ".descricao",
            "Viemos para te ajudar a focar em seus objetivos"
        ).should("be.visible");
    });

    it("testa botao de comecar", () => {
        cy.get(".btn-login")
            .should("be.visible")
            .contains("Comece a programar")
            .click();
        cy.get(".modal-title")
            .should("be.visible")
            .contains("Entrar com github");
    });

    it("verifica botoes de login e registro", () => {
        cy.get(".btn-login").click();
        cy.get(".btn-without-account")
            .should("be.visible")
            .invoke("attr", "href")
            .should("eq", "https://github.com/join?source=login");
        cy.get(".btn-account")
            .should("be.visible")
            .invoke("attr", "href")
            .should("eq", "https://improov.herokuapp.com/login/github");
    });
});
