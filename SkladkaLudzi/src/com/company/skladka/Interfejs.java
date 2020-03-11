package com.company.skladka;

import javax.swing.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class Interfejs {
    private JTextArea wyswietl;
    private JTextField Imie;
    private JTextField Kwota;
    private JButton dodajButton;
    private JTextField WpiszKwote;
    private JPanel Panel1;
    int Suma=0;


    public Interfejs() {
        Imie.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent actionEvent) {
                String text = Imie.getText();
                wyswietl.append(text + "  ");


            }
        });
        Kwota.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent actionEvent) {
                String text2 = Kwota.getText();
                wyswietl.append(text2 + "  ");
            }
        });
        dodajButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent actionEvent) {
                String text = Imie.getText();
                wyswietl.append(text + "  ");
                String text2 = Kwota.getText();
                wyswietl.append(text2 + "\n");

                String TekstKwota = Kwota.getText();
                int kwota = Integer.parseInt(TekstKwota);
                Suma += kwota;
                WpiszKwote.setText(Suma + "");

            }
        });

        WpiszKwote.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent actionEvent) {
                String text = Imie.getText();
                wyswietl.append(text + "  ");
                String text2 = Kwota.getText();
                wyswietl.append(text2 + "\n");

                String TekstKwota = Kwota.getText();
                int kwota = Integer.parseInt(TekstKwota);
                Suma += kwota;
                WpiszKwote.setText(Suma + "");
            }
        });
    }

    public static void main(String[] args) {
        JFrame frame = new JFrame("Interfejs");
        frame.setContentPane(new Interfejs().Panel1);
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.pack();
        frame.setVisible(true);
    }
}
