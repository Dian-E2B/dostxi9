<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Element\AbstractContainer;
use PhpOffice\PhpWord\Element\Text;



class WordController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'wordFile' => 'required|file|mimes:docx'
        ]);

        $file = $request->file('wordFile');
        // $filePath = $file->store('uploads');

        $phpWord = IOFactory::load($file->getRealPath());
        $sections = $phpWord->getSections();
        // dd($sections);
        // dd($phpWord); // Debug statement

        // Output the text content
        // $thirdColumnContent = $this->getThirdColumnText($phpWord);

        $thirdColumnContent = $this->separateTableAndText($phpWord);
        // dd($thirdColumnContent['tableData']);
        // dd($thirdColumnContent['otherText']);
        dd($thirdColumnContent);
        foreach ($thirdColumnContent as $content) {
        }
        // return view('word.read', ['textContent' => $textContent]);
    }


    // WordController.php

    // WordController.php

    private function separateTableAndText($phpWord)
    {
        $tableData = [];
        $otherText = [];

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if ($element instanceof \PhpOffice\PhpWord\Element\Table) {
                    // Handle table content
                    foreach ($element->getRows() as $row) {
                        if (count($row->getCells()) >= 3) {
                            // Extract text from the 3rd cell of the table
                            $thirdColumnText = $this->extractTextWithHyperlinks($row->getCells()[2]);
                            $tableData[] = $thirdColumnText;
                        }
                    }
                } elseif ($element instanceof \PhpOffice\PhpWord\Element\TextRun || $element instanceof \PhpOffice\PhpWord\Element\Text) {
                    // Handle text outside of the table
                    $textContent = $this->extractTextWithHyperlinks($element);
                    $otherText[] = $textContent;
                }
            }
        }

        return [
            'tableData' => $tableData,
            'otherText' => $otherText,
        ];
    }

    private function extractTextWithHyperlinks($cell)
    {
        $text = '';

        // Iterate through paragraphs in the cell
        foreach ($cell->getElements() as $paragraph) {
            if ($paragraph instanceof \PhpOffice\PhpWord\Element\TextRun) {
                foreach ($paragraph->getElements() as $runElement) {
                    // Check if the element is text or a hyperlink
                    if ($runElement instanceof \PhpOffice\PhpWord\Element\Text) {
                        $text .= $runElement->getText();
                    } elseif ($runElement instanceof \PhpOffice\PhpWord\Element\Link) {
                        // Extract the text from the hyperlink
                        $text .= $runElement->getText();
                    }
                }
            } elseif ($paragraph instanceof \PhpOffice\PhpWord\Element\Text) {
                // Handle text outside of TextRun
                $text .= $paragraph->getText();
            }
        }

        return $text;
    }

    private function getAllText($phpWord)
    {
        $allTextContent = [];

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if ($element instanceof \PhpOffice\PhpWord\Element\Table) {
                    // Handle table content
                    foreach ($element->getRows() as $row) {
                        if (count($row->getCells()) >= 3) {
                            // Extract text from the 3rd cell of the table
                            $thirdColumnText = $this->extractTextWithHyperlinks($row->getCells()[2]);
                            $allTextContent[] = $thirdColumnText;
                        }
                    }
                } elseif ($element instanceof \PhpOffice\PhpWord\Element\TextRun || $element instanceof \PhpOffice\PhpWord\Element\Text) {
                    // Handle text outside of the table
                    $textContent = $this->extractTextWithHyperlinks($element);
                    $allTextContent[] = $textContent;
                }
            }
        }

        // Use the result array as needed
        return $allTextContent;
    }
}
